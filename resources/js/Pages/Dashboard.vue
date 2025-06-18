<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormThought from '@/Components/FormThought.vue';
import ThoughtList from '@/Components/ThoughtList.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const thoughts = ref([])
const thoughtToEdit = ref(null)

async function fetchThoughts() {
    try {
        const res = await axios.get('/thoughts')
        thoughts.value = res.data
    } catch (error) {
        console.error(error)
    }
}

onMounted(fetchThoughts)

async function handleAddThought(newThought) {
    try {
        const res = await axios.post('/thoughts', { content: newThought.content })
        thoughts.value.unshift(res.data)
    } catch (error) {
        console.error(error)
    }
}

async function handleUpdateThought(updatedThought) {
    try {
        const res = await axios.put(`/thoughts/${updatedThought.id}`, { content: updatedThought.content })
        const index = thoughts.value.findIndex(t => t.id === updatedThought.id)
        if (index !== -1) thoughts.value[index] = res.data
        thoughtToEdit.value = null
    } catch (error) {
        console.error(error)
    }
}

async function handleDeleteThought(id) {
    try {
        await axios.delete(`/thoughts/${id}`)
        thoughts.value = thoughts.value.filter(t => t.id !== id)
    } catch (error) {
        console.error(error)
    }
}

function startEditThought(thought) {
    thoughtToEdit.value = { ...thought } // clonar para editar
}

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <FormThought :thought="thoughtToEdit" @add="handleAddThought" @update="handleUpdateThought" />
                <ThoughtList :thoughts="thoughts" @edit="startEditThought" @delete="handleDeleteThought" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
