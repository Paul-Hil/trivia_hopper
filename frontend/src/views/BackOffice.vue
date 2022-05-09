<script setup lang="ts">
import NewQuestion from '@/components/BO/NewQuestion.vue'
import HeaderSection from '@/components/HeaderSection.vue'
import FormAdmin from '@/components/BO/FormAdmin.vue'
import QuestionsList from '@/components/BO/QuestionsList.vue'

</script>

<script lang="ts">
export default {
    data() {
        return {
            isConnected_asAdmin: false,
            addNewQuestion: false,
            componentKey: 0
        }
    },
    methods: {
        isConnected(value) {
            if(value) {
                localStorage.setItem('connected_asAdmin', 'true');
                this.isConnected_asAdmin = value;
            }
        },
        handleNewQuestion(value) {
            this.addNewQuestion = value;
        },
         forceRerender() {
            this.componentKey += 1;
        }
    },
    mounted() {
        if(localStorage.getItem('connected_asAdmin')) {
            this.isConnected_asAdmin = true;
        }
    }
}
</script>

<template>
    <div>
    <HeaderSection />
        <div v-if="!isConnected_asAdmin">
            <FormAdmin @isConnected_asAdmin="isConnected" />
        </div>

        <div v-else>
            <div v-if="!addNewQuestion">
                <QuestionsList @add-new-question="handleNewQuestion" @force-rerender="forceRerender" :key="componentKey"/>
            </div>

            <div v-else>
                <NewQuestion @add-new-question="handleNewQuestion"/>
            </div>
        </div>
    </div>
</template>