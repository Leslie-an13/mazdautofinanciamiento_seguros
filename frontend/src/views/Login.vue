<template >
    <div class="col-lg-12 body">
        <div class="row">
            <div class="mx-auto col-lg-3">
                <form  class="form" @submit.prevent="validateUser">
                    <div class="container">
                        <form class="form"  @submit.prevent="validateUser">
                             <div class="heading">Iniciar sesion</div>
                             <input class="input" type="text" name="username" id="username" placeholder="Usuario" v-model="user"> 
                             <div class="d-none" id="userInvalid">
                                <small class="text-danger">Usuario invalido</small>
                             </div>
                             <input class="input" id="password" type="password" placeholder="Contraseña" v-model="clave">
                             <div class="d-none" id="passInvalid">
                                <small class="text-danger">Contraseña incorrecta</small>
                             </div>
                             <div class="forgot-password">
                                <a rel="noopener noreferrer" href="#">Olvidaste la contraseña ?</a>
                            </div>
                            <div id="crendentials" class="d-none">
                                <small class="text-danger">Credenciales invalidas</small>
                            </div>
                            <button class="login-button">Sign in</button>
                        </form>
                    </div>
                </form>
                
            </div>
            
        </div>
    </div>

</template>

<script>
import { login, fetchCurrentUser } from '../auth'

export default {
  data() {
    return {
      user: '',
      clave: ''
    }
  },
  methods: {
    async validateUser(){
        try{
            const res = await fetch('/api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'include',
                body: JSON.stringify({
                    user: this.user,
                    pass: this.clave
                })
            })

            const text = await res.text();
          
            try{
                const data = JSON.parse(text);

                if(data.success){
                    await fetchCurrentUser()
                    this.$router.push('/dashboard');

                } else{
                    let user = document.getElementById('username').value;
                    let clave = document.getElementById('password').value;

                    if(user == "" && clave == ""){
                        document.getElementById('username').classList.add('border-danger', 'border', 'border-3');
                        setTimeout(() => document.getElementById('username').classList.remove('border-danger'),3000);
                        document.getElementById('userInvalid').classList.remove('d-none');
                        setTimeout(() => document.getElementById('userInvalid').classList.add('d-none'),3000);
                 

                        document.getElementById('password').classList.add('border-danger', 'border', 'border-3');
                        setTimeout(() => document.getElementById('password').classList.remove('border-danger'),3000);
                        document.getElementById('passInvalid').classList.remove('d-none');
                        setTimeout(() => document.getElementById('passInvalid').classList.add('d-none'),3000);
                        
                        return;
                    }

                    if(user == ""){
                        document.getElementById('username').classList.add('border-danger', 'border', 'border-3');
                        setTimeout(() => document.getElementById('username').classList.remove('border-danger'),3000);
                        return;
                    }

                    if(clave == ""){
                        document.getElementById('password').classList.add('border-danger', 'border', 'border-3');
                        setTimeout(() => document.getElementById('password').classList.remove('border-danger'),3000);
                        return;
                 
                    }

                    document.getElementById('crendentials').classList.remove('d-none');
                    setTimeout(() => document.getElementById('crendentials').classList.add('d-none'),3000);

                }
            } catch(jsonError){
                //console.warn('No se pudo parsear JSON:', jsonError);
            }

        } catch{
            //console.error('Error en login',error);
            alert('Ocurrio un error al conectar al servidor');
        }
    }
  }
}
</script>