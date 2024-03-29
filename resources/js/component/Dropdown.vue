<template>
    <div class="relative">
        <div @click="open = !open">
            <slot name="trigger"></slot>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-if="open" class="fixed inset-0 z-40" @click="open = false"></div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 -translate-y-1/3"
            enter-to-class="transform opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="transform opacity-100 translate-y-0"
            leave-to-class="transform opacity-0 -translate-y-1/4"
        >
            <div
                v-if="open"
                :class="`absolute z-50 mt-2 border border-transparent overflow-hidden rounded-b-md w-${width} origin-top-${align} ${align}-0`"
                @click="open = false"
            >
                <div class="rounded-none" :class="color">
                    <slot name="content"></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { onMounted, onUnmounted, ref } from "vue";

export default {
    props: {
        align: {
            align: String,
            default: "right",
        },
        width: {
            width: String,
            default: "48",
        },
        color: {
            color: String,
            default: "bg-indigo-600 dark:bg-indigo-700",
        },
    },

    setup() {
        let open = ref(false);

        const closeOnEscape = (e) => {
            if (open.value && e.key === "Escape") {
                open.value = false;
            }
        };

        onMounted(() => document.addEventListener("keydown", closeOnEscape));

        onUnmounted(() =>
            document.removeEventListener("keydown", closeOnEscape)
        );

        return {
            open,
        };
    },
};
</script>
