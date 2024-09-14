import ShowUserPage from '@/pages/Users/ShowUserPage.vue';
import DefaultTemplate from '../layouts/DefaultTemplate.vue';
import HomePage from '../pages/HomePage.vue';
import StoreUserPage from '@/pages/Users/StoreUserPage.vue';

export const routes = [
  {
    path: '/',
    component: DefaultTemplate,
    children: [
      {
        name: 'home',
        path: '',
        component: HomePage
      },
      {
        name: 'users.show',
        path: '/users/:uuid',
        props: true,
        component: ShowUserPage
      },
      {
        name: 'users.store',
        path: '/users/store',
        component: StoreUserPage
      }
    ]
  }
];
