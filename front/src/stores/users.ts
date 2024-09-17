import UserApi from "@/infra/api/UserApi";
import { Pagination } from "@/interfaces/Pagination";
import { StoreUser, User } from "@/interfaces/User";
import { defineStore } from "pinia";

const userGateway = new UserApi();

export const useUsersStore = defineStore("users", {
  state: () => ({
    users: [] as User[],
    meta: undefined as undefined | Pagination,
  }),
  getters: {
    hasUsers: (state): boolean => state.users.length > 0,
  },
  actions: {
    async getPaginate(
      page: number = 1,
      perPage: number = 15,
    ): Promise<void> {
      await userGateway.getPaginate(page, perPage).then((response) => {
        this.users = response.users;
        this.meta = response.meta;
      });
    },
    async getUser(uuid: string): Promise<User> {
      return await userGateway.getUser(uuid);
    },
    async destroy(uuid: string): Promise<Response> {
      return await userGateway.destroy(uuid);
    },
    async store(params: StoreUser): Promise<void> {
      return await userGateway.store(params);
    },
    async update(uuid: string, params: StoreUser): Promise<void> {
      return await userGateway.update(uuid, params);
    },
  },
});
