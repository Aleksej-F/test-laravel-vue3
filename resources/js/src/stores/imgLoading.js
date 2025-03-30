import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useImgLoadingStore = defineStore('imgLoading', () => {
  const message = useMessageStore()
  const user = useUsersStore()

  const directory = ref(0)
  const visible = ref(false)
  const filesList = ref([])
  const imageSelect = ref('')

  const gle = computed(() => count.value * 2)
  
  function changeVisibility() {
    visible.value = !visible.value
  }
  
  function setImageSelect(name) {
    imageSelect.value = name
    console.log(imageSelect.value)
  }

  //получение списка файлов
  async function getFilesListCatalog(catologist) {
    // const data = JSON.stringify(user)
    try {
      const config = {
        method: 'post',
        // maxBodyLength: Infinity,
        url:'/api/v1/catalog',
        headers: { 
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          Authorization: `Bearer ${user.token}`
        },
        data: {
          catalog: catologist
        }
      }
        await axios(config)
          .then(({data})=>{
            // console.log(data.data.catalog)
            filesList.value = data.data.catalog
          })
        return true
    } catch (e) {
      console.log( e)
       message.setMessageError( e )
      return false
    }
  }

  //загрузка изображения на сервер
  async function loadImageServer(imgLoading, path) {
    // const data = JSON.stringify(user)
    try {
      const config = {
        method: 'post',
        // maxBodyLength: Infinity,
        url:'/api/v1/image',
        headers: { 
          // 'Accept': 'application/json',
          Authorization: `Bearer ${user.token}`
        },
        data:  imgLoading
        
      }
      // const responseImg = await fetch(`http://ecostroy.l7933yx2.beget.tech` + `/api/v1/image`, {
      //   method: "POST",
      //   headers: {
          
      //     Authorization: `Bearer ${user.token}`,
      //   },
      //   body:  imgLoading,
      // });
      // const dataImg = await responseImg.json();
      // console.log(dataImg)
      // message.setMessage(dataImg)
        await axios(config)
          .then(({data})=>{
            console.log(data)
            message.setMessage(data)
        })
        return true
    } catch (e) {
      console.log(e)
       message.setMessageError( e.data )
      return false
    }
  }

   //удаление изображения с сервера
   async function deleteImageServer(image) {
    // const data = JSON.stringify(user)
    try {
      const config = {
        method: 'delete',
        // maxBodyLength: Infinity,
        url:`/api/v1/image/1`,
        headers: { 
          'Accept': 'application/json',
          Authorization: `Bearer ${user.token}`
        },
        data:  image
      }
        await axios(config)
          .then(({data})=>{
            
            console.log(data)
            
          })
        return true
    } catch (e) {
      console.log(e)
      message.setMessageError( e.data )
      return false
    }
  }

  //загрузка video на сервер
  async function loadVideoServer(videoLoading, path) {
    // const data = JSON.stringify(user)
    try {
      const config = {
        method: 'post',
        // maxBodyLength: Infinity,
        url:'/api/v1/video',
        headers: { 
          // 'Accept': 'application/json',
          Authorization: `Bearer ${user.token}`
        },
        data:  videoLoading
        
      }
        await axios(config)
          .then(({data})=>{
            console.log(data)
            message.setMessage(data)
        })
        
        return true
    } catch (e) {
      console.log(e)
        message.setMessageError( e.data )
      return false
    }
  }

  //удаление video с сервера
  async function deleteVideoServer(video) {
    // const data = JSON.stringify(user)
    try {
      const config = {
        method: 'delete',
        // maxBodyLength: Infinity,
        url:`/api/v1/video/1`,
        headers: { 
          'Accept': 'application/json',
          Authorization: `Bearer ${user.token}`
        },
        data:  video
      }
        await axios(config)
          .then(({data})=>{
            console.log(data)
          })
        return true
    } catch (e) {
      console.log(e)
      message.setMessageError( e.data )
      return false
    }
  }

  return { 
    directory,  
    visible, 
    filesList,
    imageSelect,
    changeVisibility,
    getFilesListCatalog,
    setImageSelect,
    loadImageServer,
    deleteImageServer,
    loadVideoServer,
    deleteVideoServer,
  }
})
