import { Pagination } from "@/interfaces/Pagination";
import HttpAdapter from "../http/HttpAdapter";
import { StoreUser, User } from "@/interfaces/User";


export default class UserApi {
  async getPaginate(
    page: number = 1,
    perPage: number = 15,
  ): Promise<{ users: User[]; meta: Pagination }> {
    const response = await HttpAdapter
      .get(`/users?page=${page}&per_page=${perPage}`)
      .then((response) => {
        return response.data;
      });

    const users = response.data;
    return { users, meta: response.meta };
  }

  async store(params: StoreUser): Promise<any> {
    const response = await HttpAdapter.post('/users', params).then((response) => response.data).catch((error) => { throw error; });
    return response;
  }

  async getUser(uuid: string): Promise<User> {
    const response = await HttpAdapter
      .get(`/users/${uuid}`)
      .then((response) => {
        return response.data;
      });

    return response.data;
  }

  async destroy(uuid: string): Promise<Response> {
    return await HttpAdapter.delete(`/users/${uuid}`);
  }
}
