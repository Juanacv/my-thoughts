<script setup>
import ThoughtItem from '@/Components/ThoughtItem.vue';
import { defineEmits, defineProps } from 'vue';

defineProps({
    thoughts: Array,
});

const emit = defineEmits(['edit', 'delete'])
</script>

<template>
    <div>
        <ThoughtItem v-for="thought in thoughts" :key="thought.id" :id="thought.id" :createdAt="thought.created_at"
            :content="thought.content" @edit="() => emit('edit', thought)" @delete="() => emit('delete', thought.id)" />
    </div>
</template>