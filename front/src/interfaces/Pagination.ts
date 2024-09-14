export interface Pagination {
  total: number;
  current_page: number;
  from: number;
  last_page: number;
  to: number;
  per_page: number;
  links: {
    url?: string;
    label: string;
    active: boolean;
  }[];
}
