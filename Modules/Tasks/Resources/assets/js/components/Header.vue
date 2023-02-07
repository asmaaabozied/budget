<template>
    <div>
    <header class="bg-white dark:bg-dark-grey top-0 left-0 w-full flex items-center sm:pr-4">
        <div class="hidden items-center sm:flex pl-6 h-20 border-r border-r-lines-light dark:border-r-lines-dark md:h-24"
             :class=" ['min-w-[256px]', 'lg:min-w-[300px]'] ">

        </div>
        <div class="mx-auto max-w-sm w-11/12 flex items-center h-16 gap-4
    sm:h-20">
            <div>
            </div>
            <div class="flex items-center gap-2 group cursor-pointer sm:hidden">
                <h1 class="text-black dark:text-white font-bold text-lg cursor-pointer">kjglfjdgklj
                </h1>
                <IconArrowDown  />
                <IconArrowUp  />
            </div>
            <h1 class="text-black dark:text-white font-bold hidden text-2xl sm:block">
                rgdfgdfgfd
            </h1>
            <div  class="flex items-center gap-4 ml-auto">
                <AddButtonMobile />
                <PrimarySmall class="hidden sm:block">+ Add New Task</PrimarySmall>
                <Dropdown target="workspace"  />
            </div>
        </div>
    </header>
    </div>
</template>
<script setup>
import AddButtonMobile from './buttons/AddTaskMobile.vue'

import Dropdown from './manager/Dropdown.vue';
import IconArrowDown from './icons/IconArrowDown.vue';
import IconArrowUp from './icons/IconArrowUp.vue';
import PrimarySmall from './buttons/PrimarySmall.vue';


</script>
