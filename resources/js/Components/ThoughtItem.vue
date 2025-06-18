<template>
    <div class="overflow-hidden mt-4 bg-blue-100 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            Publicado en {{ new Date(createdAt).toLocaleDateString('es-ES') }}
        </div>
        <div class="p-6 text-gray-900">
            <p>
                {{ content }}
            </p>
        </div>
        <div class="p-2 bg-gray-300 flex gap-2">
            <!-- Botón Editar -->
            <button @click="edit"
                class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow transition-colors duration-200">
                Editar pensamiento
            </button>

            <!-- Botón Borrar -->
            <button @click="del"
                class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow transition-colors duration-200">
                Borrar pensamiento
            </button>
        </div>
    </div>
</template>
<script setup>
defineProps({
    id: Number,
    createdAt: String,
    content: String,
});

const emit = defineEmits(['edit', 'delete'])

function edit() {
    emit('edit')
}

function del() {
    emit('delete')
}
</script>