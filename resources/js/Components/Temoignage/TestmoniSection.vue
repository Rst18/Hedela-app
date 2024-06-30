<template>
    <div class="min-w-screen min-h-screen bg-gray-50 flex items-center justify-center py-5">
        <div class="w-full bg-white border-t border-b border-gray-200 px-5 py-16 md:py-24 text-gray-800">
            <div class="w-full max-w-6xl mx-auto">
                <div class="text-center max-w-xl mx-auto">
                    <h1 class="text-6xl md:text-7xl font-bold mb-5 text-gray-600">What people <br>are saying.</h1>
                    <h3 class="text-xl mb-5 font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
                    <div class="text-center mb-10">
                        <span class="inline-block w-1 h-1 rounded-full bg-indigo-500 ml-1"></span>
                        <span class="inline-block w-3 h-1 rounded-full bg-indigo-500 ml-1"></span>
                        <span class="inline-block w-40 h-1 rounded-full bg-indigo-500"></span>
                        <span class="inline-block w-3 h-1 rounded-full bg-indigo-500 ml-1"></span>
                        <span class="inline-block w-1 h-1 rounded-full bg-indigo-500 ml-1"></span>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <TestmoniItem image="https://i.pravatar.cc/100?img=6" name="Thx-Cap" message="Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iusto, explicabo, cupiditate quas totam!"/>
                    <TestmoniItem image="https://i.pravatar.cc/100?img=6" name="Thx-Cap" message="Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iusto, explicabo, cupiditate quas totam!"/>
                    <TestmoniItem image="https://i.pravatar.cc/100?img=6" name="Thx-Cap" message="Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iusto, explicabo, cupiditate quas totam!"/>
                    <TestmoniItem image="https://i.pravatar.cc/100?img=6" name="Thx-Cap" message="Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iusto, explicabo, cupiditate quas totam!"/>
                    <TestmoniItem image="https://i.pravatar.cc/100?img=6" name="Thx-Cap" message="Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iusto, explicabo, cupiditate quas totam!"/>
                   

                </div>
            </div>
        </div>  
    </div>
</template>
<script setup>
    import TestmoniItem from './TestmoniItem.vue'
</script>