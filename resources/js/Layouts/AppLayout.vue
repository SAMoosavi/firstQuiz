<template>
    <div>
        <Head :title="title" />
        <div class="min-h-screen bg-indigo-100 dark:bg-slate-900">
            <nav class="h-full bg-indigo-600 dark:bg-indigo-700">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-4">
                            <on-off-dark-mode />
                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <nav-link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    داشبورد
                                </nav-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="relative ml-3">
                                <Dropdown :align="'left'" :width="'48'">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm transition focus:outline-none"
                                        >
                                            <img
                                                class="object-cover w-8 h-8 rounded-full"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-400 transition dark:text-gray-800/70 hover:text-white dark:hover:text-black dark:focus:text-black focus:outline-none focus:text-white"
                                            >
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="mr-1.5 h-5 w-5"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-400"
                                        >
                                            مدیریت حساب
                                        </div>

                                        <Dropdown-link
                                            :href="route('profile.show')"
                                        >
                                            پروفایل
                                        </Dropdown-link>

                                        <div
                                            class="border-t border-gray-100 dark:border-gray-800"
                                        ></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <Dropdown-link
                                                as="button"
                                                class="flex"
                                            >
                                                خروج
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="inline-block w-4 h-4 mr-2"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="square"
                                                        stroke-linejoin="square"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                    />
                                                </svg>
                                            </Dropdown-link>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -ml-2 sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 text-gray-300 transition rounded-none dark:text-gray-400 hover:text-gray-100 hover:dark:text-gray-900 focus:text-white focus:dark:text-black focus:outline-none"
                            >
                                <svg
                                    class="w-6 h-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <!-- <transition
                    enter-active-class="transition-all duration-1000 ease-in"
                    enter-from-class="h-0 origin-top transform opacity-0"
                    enter-to-class="h-full transform"
                    leave-active-class="transition-all duration-1000 ease-in"
                    leave-from-class="w-full transform"
                    leave-to-class="w-0 transform"
                    tag="div"
                    class="overflow-hidden"
                    mode="out-in"
                > -->
                    <div v-if="showingNavigationDropdown" class=" sm:hidden">
                        <div class="pt-2 ">
                            <responsive-nav-link
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                داشبورد
                            </responsive-nav-link>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 border-t border-gray-200 dark:border-black">
                            <div class="flex items-center px-4">
                                <div
                                    v-if="
                                        $page.props.jetstream
                                            .managesProfilePhotos
                                    "
                                    class="mr-3 shrink-0"
                                >
                                    <img
                                        class="object-cover w-10 h-10 rounded-full"
                                        :src="
                                            $page.props.user.profile_photo_url
                                        "
                                        :alt="$page.props.user.name"
                                    />
                                </div>

                                <div>
                                    <div
                                        class="text-base font-medium text-gray-100 dark:text-gray-800"
                                    >
                                        {{ $page.props.user.name }}
                                    </div>
                                    <div
                                        class="text-sm font-medium text-gray-300 dark:text-gray-700"
                                    >
                                        {{ $page.props.user.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <responsive-nav-link
                                    :href="route('profile.show')"
                                    :active="route().current('profile.show')"
                                >
                                    پروفایل
                                </responsive-nav-link>

                                <!-- Authentication -->
                                <form method="POST" @submit.prevent="logout">
                                    <responsive-nav-link as="button">
                                        خروج
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="inline-block w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="square"
                                                stroke-linejoin="square"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                    </responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- </transition> -->
            </nav>

            <!-- Page Heading -->
            <header
                class="text-white bg-indigo-400/75 dark:bg-indigo-500/75 dark:text-black"
                v-if="$slots.header"
            >
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h2 class="text-xl font-semibold leading-tight">
                        <slot name="header"></slot>
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import OnOffDarkMode from "@/component/OnOffDarkMode.vue";
import Dropdown from "@/component/Dropdown.vue";
import DropdownLink from "@/component/DropdownLink.vue";
import NavLink from "@/component/NavLink.vue";
import ResponsiveNavLink from "@/component/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        title: String,
    },

    components: {
        Head,
        Dropdown,
        DropdownLink,
        NavLink,
        ResponsiveNavLink,
        Link,
        OnOffDarkMode,
    },

    setup() {
        const showingNavigationDropdown = ref(false);
        function logout() {
            Inertia.post(route("logout"));
        }

        return {
            showingNavigationDropdown,
            logout,
        };
    },
};
</script>
