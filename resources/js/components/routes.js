import Home from './components/Home';
import About from './components/About';
import Create from './components/Create';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';

export default{
    mode: 'history',
    linkActiveClass: 'font-semibold',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        {
            path: '/about',
            component: About
        },
        {
            path: '/create',
            component: Create
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: "/dashboard",
            name: "Dashboard",
            // component: Dashboard,
           // beforeEnter: (to, form, next) =>{
           //     axios.get('/api/athenticated', { headers: {"Authorization" : `Bearer `+localStorage.getItem('token_bearer')}}).then(()=>{
           //         next()
           //     }).catch(()=>{
           //         return next({ name: 'Login'})
           //     })
           // }
       
          }
          
    ]
}