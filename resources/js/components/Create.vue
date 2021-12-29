<template>
      <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
            <div class="p-2 w-full">
                <label class="w-full" for="name">First Name</label>
                <span class="w-full text-red-500" v-if="errors.first_name">{{errors.first_name[0]}}</span>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Name" type="text" v-model="form.first_name" name="first_name">
            </div>
            <div class="p-2 w-full">
                <label class="w-full" for="name">Last Name</label>
                <span class="w-full text-red-500" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Name" type="text" v-model="form.last_name" name="last_name" >
            </div>

            <div class="p-2 w-full">
                <label class="w-full" for="name">Mobile number</label>
                <span class="w-full text-red-500" v-if="errors.mobile_num">{{errors.mobile_num[0]}}</span>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Name" type="text" v-model="form.mobile_num" name="mobile_num" >
            </div>

            <div class="p-2 w-full">
                <label for="email">Your e-mail</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="email" v-model="form.email" name="email">
            </div>
            <div class="p-2 w-full">
                <label for="password">Password</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-full">
                <label for="confirm_password">Confirm Password</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Confirm Password" type="password" v-model="password_confirmation" name="password_confirmation">
            </div>
            <div class="p-2 w-full mt-4">
                <button @click.prevent="saveForm" type="submit" class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Register</button>
            </div>
        </div> 
    </div>
</template>
<script>

const token = localStorage.getItem('token_bearer');
export default {
    data(){
        return{
            form:{
                first_name: '',
                last_name: '',
                mobile_num: '',
                email: '',
                password:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/create', this.form, { headers: {"Authorization" : `Bearer ${token}`}}).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>