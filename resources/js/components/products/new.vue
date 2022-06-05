<script setup>
 import { toStatement } from "@babel/types";
import axios from "axios";
import { ref } from "vue";
import  {useRouter} from "vue-router";
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const FilePond = vueFilePond(
  FilePondPluginImagePreview
);
var path=""
const form = ref ({
name:'',
description:'',
photo:'',
type:'', 
quantity:'',
price:''
})
const router = useRouter();

       
const onFileChange =(e) => {
     path = '../storage/images/'+e.target.files[0].name ;

 }
const saveProduct = () => {
    path = path ;
    const formData = new FormData()
    formData.append('name', form.value.name) 
    formData.append('description', form.value.description)
    formData.append('photo',path)
    formData.append('type', form.value.type)
    formData.append('quantity', form.value.quantity)
    formData.append('price', form.value.price)
    axios.post("/api/add_product/", formData)
    .then((response)=>{
        form.value.name='',
        form.value.description='',
        form.value.photo ='',
        form.value.type ='',
        form.value.quantity ='',
        form.value.price ='',

        router.push('/')
        toStatement.fire({
            icon:"success",
            title:"Product add successfully"
        })
    })
    .catch((error) => {

    })}
   





</script>
<template>
<div class="container" >
    <div class="products__create ">
    
             <div class="products__create__titlebar dflex justify-content-between align-items-center">
                 <div class="products__create__titlebar--item">
                     
                     <h1 class="my-1">Add Product</h1>
                 </div>
                 <div class="products__create__titlebar--item">
                     
                     <button class="btn btn-secondary ml-1" @click="saveProduct()" >
                         Save
                     </button>
                 </div>
             </div>

             <div class="products__create__cardWrapper mt-2">
                 <div class="products__create__main">
                     <div class="products__create__main--addInfo card py-2 px-2 bg-white">
                         <p class="mb-1">Name</p>
                         <input type="text" class="input" v-model="form.name">

                         <p class="my-1">Description (optional)</p>
                         <textarea cols="10" rows="5" class="textarea" v-model="form.description" ></textarea>
                         
                         <div class="products__create__main--media--images mt-2">
                            <ul class="products__create__main--media--images--list list-unstyled">
                                <li class="products__create__main--media--images--item">
                                    
                                </li>
                                <!-- upload image small -->
                                <li class="products__create__main--media--images--item">
                                    <form class="products__create__main--media--images--item--form">
 <input type="file" max-files="1" @change="onFileChange"/>

 </form>
                                </li>
                            </ul>
                        </div>
                    
                     </div>

                 </div>
                 <div class="products__create__sidebar">
                     <!-- Product Organization -->
                     <div class="card py-2 px-2 bg-white">
                         
                         <!-- Product unit -->
                         <div class="my-3">
                             <p>Product type</p>
                             <input type="text" class="input" v-model="form.type" >
                         </div>
                         <hr>

                         <!-- Product invrntory -->
                         <div class="my-3">
                             <p>Inventory</p>
                             <input type="text" class="input" v-model="form.quantity" >
                         </div>
                         <hr>

                         <!-- Product Price -->
                         <div class="my-3">
                             <p>Price</p>
                             <input type="text" class="input"  v-model="form.price">
                         </div>
                     </div>

                 </div>
             </div>
             <!-- Footer Bar -->
             <div class="dflex justify-content-between align-items-center my-3">
                 <p ></p>
                 <button class="btn btn-secondary" @click="saveProduct()" >Save</button>
             </div>
         
     </div>

</div></template>