export interface User {
  id: number;
  name: string;
  email: string;
  phone: string;
  uuid: string;
  birthday: string;
  created_at: string;
  updated_at: string;
}

export interface StoreUser {
  name: string;
  email: string;
  phone?: string;
  birthday: string;
}
