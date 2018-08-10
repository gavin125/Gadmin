<template>
  <div class="position-absolute column">
    <b-list-group class="border-bottom" v-for='group in menu'>
      <b-list-group-item v-for='item in group' class="border-0 rounded-0 py-2" :href='item.link' v-text='item.text' :variant='item.active?"success":""'></b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>

export default {
  props:['menu'],
  data () {
    return {}
  },
  mounted () {},
};

</script>
