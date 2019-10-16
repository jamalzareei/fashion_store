<template>

    <nav id="nav" v-if="$router.currentRoute.name != 'login'">
        <ul class="nav justify-content-end">
            
            
            <!--UNLOGGED-->
            <li  class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                <router-link  class="nav-link" :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGGED USER-->
            <li  class="nav-item"  v-for="(route, key) in routes.user" v-bind:key="route.path">
                <router-link  class="nav-link" :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGGED ADMIN-->
            <li  class="nav-item"  v-for="(route, key) in routes.admin" v-bind:key="route.path">
                <router-link  class="nav-link" :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGOUT-->
            <li  class="nav-item" v-if="$auth.check()">
                <a href="#" @click.prevent="$auth.logout()">Logout</a>
            </li>
        </ul>
    </nav>
</template>
<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Inscription',
              path: 'register'
            },
            {
              name: 'Connexion',
              path: 'login'
            }
          ],
          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'dashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            }
          ]
        }
      }
    },
    mounted() {
      //
        console.info('App this router:', this.$router)
        console.info('App currentRoute:', this.$router.currentRoute.name)
    }
  }
</script>