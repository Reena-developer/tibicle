import About from './components/About';
import Create from './components/Create';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';


export default{
    mode: 'history',
    linkActiveClass: 'font-semibold',
    routes: [
        /*{
            path: '*',
            component: NotFound
        },*/
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
            component: Dashboard,
           beforeEnter: (to, form, next) =>{
               axios.get('/api/athenticated').then(()=>{
                   next()
               }).catch(()=>{
                   return next({ name: 'Login'})
               })
           }
       
          }
          
    ]
}