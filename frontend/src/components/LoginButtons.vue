<script>
export default {
    data() {
        return {
            isConnected: false,
            username: null
        }
    },
    methods: {
        handleConnectionDiscord(result) {
            if(result) {
                this.isConnected = true;
                this.$emit('isConnected', this.isConnected);
            } else {
                this.isConnected = false;
                this.$emit('isConnected', this.isConnected);
                localStorage.clear();
            }
        },
    },
    mounted() {
        const username = localStorage.getItem('username');
        const discriminator = localStorage.getItem('discriminator');

        if(username && discriminator) { // Already connected
            this.handleConnectionDiscord(true);
            this.username = username;
        } else { // Not connected
            const fragment = new URLSearchParams(window.location.hash.slice(1));
            const accessToken = fragment.get('access_token'); // Get acces token from Discord

            if(accessToken) { // Linked to Discord
                window.history.replaceState(null, null, window.location.pathname);
                getInfosDiscord(accessToken);
                this.handleConnectionDiscord(true);
            }
        }
        this.$emit('isConnected', this.isConnected);
        this.$emit('username', this.username);
    },
}

function getInfosDiscord(accessToken) {
        if(accessToken) { // if first linked
            localStorage.setItem('accessToken', accessToken);
        }
    
        fetch('https://discord.com/api/users/@me', {
            headers: {
                authorization: `Bearer ${localStorage.getItem('accessToken')}`,
            },
        })
            .then(result => result.json())
            .then(response => {
                const { username, discriminator } = response;

                localStorage.setItem('username', username );
                localStorage.setItem('discriminator', discriminator);

                if(username && discriminator) {
                    location.reload(true);
                    return true;
                } 
                return false;
            })
            .catch(console.error);
    }
</script>

<template>
    <section>
        <a v-if="!isConnected" href="https://discord.com/api/oauth2/authorize?client_id=959861766836322375&redirect_uri=http%3A%2F%2Flocalhost%3A3000&response_type=token&scope=identify">
            <button
            @click="$emit(this.username)"
                >Login with Discord
            </button>
        </a>

        <a v-else>
            <router-link to="/">
                <button
                    @click="handleConnectionDiscord(false)"
                    >Disconnect from Discord
                </button>
            </router-link>
        </a>

        <button
            id="loginAdmin"
            >Login admin
        </button>
    </section>
</template>

<style scoped>
@import '../assets/base.css';

    
</style>