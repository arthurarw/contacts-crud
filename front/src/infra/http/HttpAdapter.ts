import axios, { AxiosInstance } from 'axios';

import { API_URL, NAME_TOKEN } from '../../settings';

import HttpClient from './HttpClient';

class HttpAdapter implements HttpClient {
  private static instance: HttpAdapter | null = null;
  private axiosInstance: AxiosInstance | null = null;

  constructor() {
    const baseURL = API_URL;
    this.axiosInstance = axios.create({
      baseURL,
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      }
    });
  }

  static getInstance(): HttpClient {
    if (!this.instance) {
      this.instance = new HttpAdapter();
    }

    return this.instance;
  }

  withAuthorization(): this {
    if (this.axiosInstance) {
      const token = localStorage.getItem(NAME_TOKEN);
      this.axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }

    return this;
  }

  async get(url: string, configs?: object | undefined): Promise<any> {
    return await this.axiosInstance?.get(url, configs);
  }
  async post(url: string, body: object, configs?: object | undefined): Promise<any> {
    return await this.axiosInstance?.post(url, body, configs);
  }
  async put(url: string, body: object, configs?: object | undefined): Promise<any> {
    return await this.axiosInstance?.put(url, body, configs);
  }
  async delete(url: string, configs?: object | undefined): Promise<any> {
    return await this.axiosInstance?.delete(url, configs);
  }
}

export default HttpAdapter.getInstance();
