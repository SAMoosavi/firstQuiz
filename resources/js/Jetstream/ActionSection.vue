<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-white shadow sm:p-6 sm:rounded-lg">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import SectionTitle from '@/component/SectionTitle.vue'

    export default defineComponent({
        components: {
            SectionTitle,
        }
    })
</script>
