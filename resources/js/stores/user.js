import { ref } from "vue";
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", () => {
    const users = ref([]);

    async function fetchData() {
      let response = await fetch('https://signio-prueba.test/api/users');
      let { data } = await response.json();
      this.users = data;
    }

    return { users, fetchData };
});
