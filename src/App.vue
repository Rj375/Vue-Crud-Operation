<template>
  <div id="app">
      
    <router-view/>
    
   
  </div>
</template>




<style lang="scss">
#app {
  
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
 
  
}

#nav {
 

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
