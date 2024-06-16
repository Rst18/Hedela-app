<template>
    <div>
        <section v-if="editor" @click="editor.prevent" class="buttons rounded-t-lg border-gray-300 flex items-center flex-wrap gap-x-4 border-t border-l border-r border-gray-400 p-2 ">
            <button  @click="editor.chain().focus().toggleBold().run()" 
                        :disabled="!editor.can().chain().focus().toggleBold().run()" 
                        :class="{ 'bg-gray-400': editor.isActive('bold') }">
               <BoldIcon/>
            </button>
            <button @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
                <ItalicIcon/>
            </button>
            <button @click="editor.chain().focus().toggleStrike().run()" :disabled="!editor.can().chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
                <striket-icon/>
            </button>
            <button @click="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
                <code-block-brackets-icon/>
            </button>
            <button @click="editor.chain().focus().unsetAllMarks().run()">
            Clear marks
            </button>
            <button @click="editor.chain().focus().clearNodes().run()">
            Clear nodes
            </button>
            <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
            Blockquote
            </button>
            <button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
                <ParagraphIcon/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
                <Header1Icon/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
                <Header2Icon/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
                <Header3Icon/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
                <Header4Icon/>
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
                <Header5Icon/>
            </button>
            <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
                <ListBulletedIcon/>
            </button>
            <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
                <!-- <ListNumbersIcon/> -->
            </button>
            <button @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
                <CodeArrayIcon/>
            </button>
                
            <button @click="editor.chain().focus().setHardBreak().run()">
                <PageBreakIcon/>
            </button>
            <button @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()">
                <undo-icon/>
            </button>
            <button @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()">
                <RedoIcon/>
            </button>
        </section>
        <editor-content :editor="editor" />
    </div>
</template>

<script setup>

    import { useEditor, EditorContent } from '@tiptap/vue-3'
    import StarterKit from '@tiptap/starter-kit'
    // import Underline from '@tiptap/extension-underline'
    import BoldIcon from 'vue-material-design-icons/FormatBold.vue';
    import ItalicIcon from 'vue-material-design-icons/FormatItalic.vue';
    import StriketIcon from 'vue-material-design-icons/FormatStrikethrough.vue';
    import UnderlineIcon from 'vue-material-design-icons/FormatUnderline.vue';
    import UndoIcon from 'vue-material-design-icons/Undo.vue';
    import RedoIcon from 'vue-material-design-icons/Redo.vue';

    import CodeBlockBracketsIcon from 'vue-material-design-icons/CodeBlockBrackets.vue';
    import ListBulletedIcon from 'vue-material-design-icons/FormatListBulleted.vue';
    import ParagraphIcon from 'vue-material-design-icons/FormatParagraph.vue';
    import Header1Icon from 'vue-material-design-icons/FormatHeader1.vue';
    import Header2Icon from 'vue-material-design-icons/FormatHeader2.vue';
    import Header3Icon from 'vue-material-design-icons/FormatHeader3.vue';
    import Header4Icon from 'vue-material-design-icons/FormatHeader4.vue';
    import Header5Icon from 'vue-material-design-icons/FormatHeader5.vue';
    import CodeArrayIcon from 'vue-material-design-icons/CodeArray.vue';
    import PageBreakIcon from 'vue-material-design-icons/FormatPageBreak.vue';

    // import ListNumbersIcon from 'vue-material-design-icons/FormatListNumbers.vue';

    
    
        const props = defineProps({
            modelValue:String
        })
        const emit  = defineEmits(['update:modelValue'])
        const editor = useEditor({
            editorProps: {
                
                attributes: {

                    class:'border border-gray-400 p-4 prose max-w-none min-h-[12rem] rounded-b-lg bg-gray-50 outline-none',
                },
                // prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none
            },
            onUpdate:({editor})=>{
                emit('update:modelValue',editor.getHTML())
            },
            content: props.modelValue,
            extensions: [
                StarterKit,
            ],
        })
</script>
<style >



</style>