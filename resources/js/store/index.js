import { createStore } from "vuex";

export default createStore({
    state() {
        return {
            // Creat Quiz
            questions: {},
            lengthQuestions: 0,
            // Answer Quiz
            answers: {},
            noAnswer: 0,
        };
    },
    mutations: {
        // Creat Quiz
        editQuestions(state, { question, index }) {
            state.questions[index] = question;
        },
        addQuestions(state, index) {
            state.questions = { ...state.questions, [index]: {} };
            state.lengthQuestions++;
        },
        removeQuestion(state, index) {
            delete state.questions[index];
            state.lengthQuestions--;
        },
        clearQuestions(state) {
            state.questions = {};
            state.lengthQuestions = 0;
        },
        // Answer Quiz
        addAnswer(state, { index, ans }) {
            let answer;
            if (ans.ans) {
                answer = ans.ans;
            } else {
                answer = "";
                state.noAnswer++;
            }
            state.answers = {
                ...state.answers,
                [index]: { id: ans.id, ans: answer, type: ans.type },
            };
        },
        editAnswer(state, { index, ans }) {
            if (ans.ans == "" && state.answers[index].ans != "")
                state.noAnswer++;
            if (ans.ans != "" && state.answers[index].ans == "")
                state.noAnswer--;
            state.answers[index].ans = ans.ans;
        },
    },
    getters: {
        // Creat Quiz
        getQuestions(state) {
            return state.questions;
        },
        getSizeQuestions(state) {
            return state.lengthQuestions;
        },
        // Answer Quiz
        getAnswer(state) {
            return state.answers;
        },
        getNoAnswer(state) {
            return state.noAnswer;
        },
    },
});
