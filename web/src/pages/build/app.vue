<template>
  <div class="bg">
    <div class="main">
      <img src="../../assets/building.png" alt="">

      <!-- foot -->
      <xggFoot></xggFoot>
    </div>
  </div>
</template>

<style>
  body{font-size: 12px; }
  .bg{ position: absolute; width: 100%; height: 100%; background: -webkit-radial-gradient(#fff 10%,#ccc 80%); display: flex; justify-content: center; align-items: center; }
  .main{ text-align: center; }

</style>

<script>

import xggFoot from '../../components/xggFoot.vue'

export default {
  components: {
    xggFoot
  },
  data () {
    return {
      manager:{user_name:'',email:''},
    }
  },

  mounted () {},
  methods:{
    
  }

};

</script>
