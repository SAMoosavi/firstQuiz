<template>
    <div class="w-full p-4">
        <div class="my-2 font-medium">
            <h3>{{ question.questions }}</h3>
        </div>
        <div>
            <my-input class="w-full md:w-1/2 lg:w-1/3" v-model.lazy="ans.ans" /> {{props.question.point}}
        </div>
    </div>
</template>

<script setup>
import { reactive } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";
import { useStore } from "vuex";
import MyInput from "@/component/Input.vue";

const props = defineProps(["question", "in"]);
const index = props.in;
const ansLocalstoreeg = !!localStorage.getItem(props.question.id)
    ? localStorage.getItem(props.question.id)
    : null;

const ans = reactive({
    type: props.question.type,
    id: props.question.id,
    ans: ansLocalstoreeg,
});
const store = useStore();
onMounted(() => {
    store.commit("addAnswer", { index, ans });
});

watch(
    () => ans.ans,
    (value) => {
        localStorage.setItem(ans.id, value);
        store.commit("editAnswer", { index, ans });
    }
);
</script>
