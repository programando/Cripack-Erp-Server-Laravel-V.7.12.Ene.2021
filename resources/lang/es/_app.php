<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VARIABLES GENERALES
    |--------------------------------------------------------------------------
    | Las siguientes variables se usan en diferentes sitios del aplicativo
-   |---------------------------------------------------------------------------
    |
    */
         'EMPRESA'                   => 'Cripack',
         'APP_NAME'                   => 'WebCross',
         'TEXT_SOPORTE'               => 'Soporte Cripack',
         'EMAIL_SOPORTE'              => 'croscut@cripack.com',


         /*
         |--------------------------------------------------------------------------
         | BOTONES
         |--------------------------------------------------------------------------
         */
         'btn_actualizar_lg'  => 'Actualizar registro',
         'btn_actualizar_sm'  => 'Actualizar',
         'btn_cancelar'       => 'Cancelar',
         'btn_cerrar'         => 'Cerrar',
         'btn_editar'         => 'Editar',
         'btn_eliminar'       => 'Borrar',
         'btn_email_new_pass' => 'Crear una nueva contraseña',
         'btn_enviar_email'   => 'Enviar Correo',
         'btn_grabar_lg'      => 'Grabar registro',
         'btn_grabar_sm'      => 'Grabar',
         'btn_inactiva_lg'    => 'Inactivar este registro ?',
         'btn_inactiva_sm'    => 'Inactivar ?',
         'btn_ingresar_sys'   => 'Ingresar al sistema',
         'btn_nuevo_registro' => 'Crear nuevo registro',
         'btn_reset_password' => 'Actualizar contraseña',
         'btn_go_to_home'     => 'Volver a Inicio',



         /*
         |--------------------------------------------------------------------------
         | LABELS GENERICOS
         |--------------------------------------------------------------------------
         */
         'email_lbl'                  => 'Correo electrónico',
         'passw_lbl'                  => 'Contraseña',
         'passw_lbl_confirma'         => 'Confirma tu contraseña',


         /*
         |--------------------------------------------------------------------------
         | PLACE HOLDERS GENERICOS
         |--------------------------------------------------------------------------
         */
         'email_placeholder'          => 'Digita tu correo electrónico',
         'passw_placeholder'          => 'Digita tu contraseña',
         'passw_placeholder_confirma' => 'Confirma tu contraseña',

         /*
         |--------------------------------------------------------------------------
         | ERRORES
         |--------------------------------------------------------------------------
         */
         'email_error'                => 'Correo electrónico no encontrado en nuestro registros o no autorizado para este procedimiento',
         'email_pass_error'           => 'Correo electrónico y contraseña no encontrados en nuestros registros o el usuario no ha sido autorizado.',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO LOGIN (terceros\login)
         |--------------------------------------------------------------------------
         */
         'frase_user_lbl'             => 'Registrada por : ',
         'passw_asing_lbl'            => 'Quiero asignar una para ingreso a mi cuenta',
         'passw_asing_title_lbl'      => 'Aún no tengo contraseña,',
         'passw_forget_lbl'           => 'He olvidado mi contraseña, por favor recordármela.',
         'sesion_chk_lbl'             => 'No cerrar sessión',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO RESET PASSWORD ENVIO EMAIL ( passwords\recordar)
         |--------------------------------------------------------------------------
         */
         'pass_remember_text'         => 'A través de este proceso enviaremos las indicaciones para que, desde su cuenta de correo electrónico, pueda asignar una nueva contraseña.',
         'pass_remember_title'        => 'Cambiar contraseña de usuario',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO RESET PASSWORD MENSAJE ENVIADO ( passwords\recordar-msg-ok)
         |--------------------------------------------------------------------------
         */
         'pass_remember_title_msg_ok' => 'Confirmación envío de correo',
         'pass_remember_text_ok'      => 'Hemos enviado un mensaje junto con un código de validación a la dirección de correo: <strong> :email </strong>  registrada en nuestro sistema.  Por favor revíselo y siga las instrucciones para reestablecer su contraseña. <i><small><br><strong>Tenga en cuenta que el código expirará en 15 minutos </strong></small></i> <br><br> No olvide revisar su bandeja de correo no deseado y de recibirlo allí, asegúrese de incluir nuestra dirección como sitio de confianza para que siga recibiendo nuestras notificaciones.',


         /*
         |--------------------------------------------------------------------------
         | FORMULARIO RESET PASSWORD CONTENIDO EMAIL ( emails\password-recovery)
         |--------------------------------------------------------------------------
         */
         'asunto_pass_forget'         => 'Recuperación de contraseña',
         'email_pass_recovey_text'    => 'Para restablecer su contraseña, simplemente presione click en el siguiente enlace : ',
         'email_pass_no_recovey_text' => 'En caso de que usted no haya realizado esta solicitud, haga caso omiso de este correo y bórrelo. No haremos ningún cambio en su registro.',
         'email_pass_recovey_footer'  => 'Usted está recibiendo este correo porque se encuentra registrado en la base de datos de Balquimia ERP',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO RESET PASSWORD  ( passwords\reset)
         |--------------------------------------------------------------------------
         */
         'pass_reset_text'            => 'Registra y confirma tu contraseña para actualizar los registros en nuestro sistema.',
         'token_expirado'             => 'Posiblemente han pasado más de 15 minutos y el código enviado se ha desabilitado. Debe iniciar nuevamente el proceso para reestablecer su contraseña.',
         'token_invalid'              => '¡¡¡Oopss !!! <br> El código asociado al correo electrónico no existe nuestros registros, por favor inicie el proceso nuevamente.',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO PERFILES
         |--------------------------------------------------------------------------
         */
         'perfil_form_title'      => 'Cargos/Perfiles',
         'perfil_form_dscrip'     => 'Descripción del cargo/perfil',
         'perfil_form_update'     => 'Actualizar cargo/Perfil',
         'perfil_form_new'        => 'Descripción del cargo/perfil',
         'perfil_form_placeholder'=> 'Escriba el cargo/perfil',

         /*
         |--------------------------------------------------------------------------
         | FORMULARIO MARCAS
         |--------------------------------------------------------------------------
         */
         'marcas_form_title'      => 'Marcas',
         'marcas_form_dscrip'     => 'Descripción de la marca',
         'marcas_form_update'     => 'Actualizar Marca',
         'marcas_form_new'        => 'Descripción de la marca',
         'marcas_form_placeholder'=> 'Escriba la marca',





];
