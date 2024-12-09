<template>
    
    <Header/>
        
    <Hero/>
        
    <slot/>
        
    <Footer/>
        

</template>

<script sutup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Header from './Header.vue';
import Hero from './Hero.vue';
import Footer from './Footer.vue';

export default {
  components: {
    Header,
    Hero,
    Footer
  },
};

onMounted(()=> {
    initFlowbite()
})
</script>