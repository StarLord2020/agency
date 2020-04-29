<template>
    <div>

    </div>
</template>

<script>

    export default {
        props:['lesson','day'],
        data() {
            return {
                show: false,
                variants: ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'],
                headerBgVariant: 'dark',
                headerTextVariant: 'light',
                bodyBgVariant: 'light',
                bodyTextVariant: 'dark',
                footerBgVariant: 'warning',
                footerTextVariant: 'dark',
                userName:""
                ,
                d:""
            }
        },
        created() {

           this.userName=this.lesson;
           this.d=this.day;
        }

    }
</script>
