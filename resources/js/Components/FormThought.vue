<script setup>
import { ref, watch, toRefs } from 'vue';

const props = defineProps({
    thought: Object // el pensamiento a editar, o null para añadir
})

const emit = defineEmits(['add', 'update'])

const { thought } = toRefs(props)

const thoughtText = ref('')

// Cada vez que cambie `thought`, actualizar el input:
watch(thought, (newVal) => {
    thoughtText.value = newVal ? newVal.content : ''
})

function submitThought() {
    if (!thoughtText.value.trim()) return

    if (thought.value) {
        // Editando
        emit('update', { id: thought.value.id, content: thoughtText.value.trim() })
    } else {
        // Añadiendo nuevo
        emit('add', { content: thoughtText.value.trim() })
    }
    thoughtText.value = ''
}
</script>

<template>
    <div class="overflow-hidden bg-blue-100 shadow-sm sm:rounded-lg" id="thoughtForm" name="thoughtForm">
        <div class="p-6 text-gray-900">
            <p class="text-xl font-semibold text-gray-600 mb-2">¿En qué estás pensando?</p>

            <form>
                <div>
                    <label for="thought" class="block text-sm font-medium text-gray-700">
                        Estoy pensando en:
                    </label>
                    <input type="text" id="thought" v-model="thoughtText" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
            </form>
        </div>
        <div class="mt-4 bg-gray-300 flex gap-2 p-2">
            <button @click="submitThought" type="button"
                class="bg-blue-800 hover:bg-blue-900 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-300">
                {{ thought ? 'Guardar cambios' : 'Enviar pensamiento' }}
            </button>
        </div>
    </div>
</template>
