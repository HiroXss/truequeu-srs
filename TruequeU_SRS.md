# TruequeU — Especificación de Requerimientos de Software (SRS)
### Plataforma de Trueque Estudiantil

**Autor:** _(tu nombre)_
**Programa:** Tecnología en Desarrollo de Software
**Stack:** Laravel 12 (PHP 8.2+) · MySQL (gestionado con Laragon) · Blade + Bootstrap
**Versión:** 1.0 — 2026

> Nota: este documento sigue la misma estructura del SRS de referencia (RestauManager), adaptada al alcance de un proyecto de semestre. Los apartados marcados como "opcional / nivel avanzado" son ampliaciones que puedes incluir si el tiempo lo permite, o dejar como trabajo futuro.

---

## Contenido
1. Introducción
2. Descripción General
3. Requerimientos Específicos (incluye 3.4 Reglas de Negocio)
4. Requerimientos Funcionales Detallados (por módulo)
5. Casos de Uso
6. Historias de Usuario
7. Diagramas de Actividades
8. Entrevista y Tabulación de Resultados
9. Manual de Instalación
10. Manual de Usuario

---

## 1. Introducción

### 1.1 Propósito
Este documento especifica los requisitos funcionales y no funcionales de **TruequeU**, una plataforma web que permite a estudiantes publicar artículos o servicios para intercambiar (trueque), buscarlos mediante filtros y contactar a otros usuarios interesados. El sistema se desarrolla con Laravel 12, Blade y Bootstrap para el frontend, y MySQL como motor de base de datos.

### 1.2 Ámbito del Sistema
**Nombre del sistema:** TruequeU.
**Descripción:** aplicación web que centraliza la publicación, búsqueda y contacto de artículos/servicios para trueque entre estudiantes de una institución. Incluye autenticación, gestión de publicaciones, categorías, búsqueda con filtros, mensajería interna básica y, opcionalmente, moderación administrativa y reputación de usuarios. Opera en español.
**Beneficiarios:** estudiantes de la institución que deseen intercambiar artículos o servicios sin intermediar dinero, y el personal administrador que modera el contenido publicado.

### 1.3 Definiciones, Acrónimos y Abreviaturas
- **SRS:** Especificación de Requerimientos de Software.
- **BD:** Base de Datos.
- **CRUD:** Crear, Leer, Actualizar y Eliminar.
- **Trueque:** intercambio de un artículo o servicio por otro, sin transacción monetaria.
- **Publicación:** anuncio creado por un usuario que describe lo que ofrece y lo que busca a cambio.
- **RF / RNF:** Requerimiento Funcional / No Funcional. **RN:** Regla de Negocio. **CU:** Caso de Uso. **HU:** Historia de Usuario.

### 1.4 Visión General del Documento
El documento sigue el orden del índice: primero se describe el sistema en general, luego se listan los requerimientos funcionales y no funcionales, se detallan por módulo, se documentan los casos de uso y las historias de usuario, se describen los flujos principales y, finalmente, se incluyen los manuales de instalación y de usuario.

---

## 2. Descripción General

### 2.1 Perspectiva del Producto
TruequeU es una aplicación web monolítica construida con Laravel 12 (arquitectura MVC), vistas Blade y Bootstrap. La base de datos MySQL se gestiona localmente con Laragon durante el desarrollo. El sistema no depende de servicios de pago ni de una API externa para su versión base; el alcance móvil o de API REST queda como ampliación futura (ver 2.6).

### 2.2 Funciones del Producto
- **Autenticación:** registro, inicio y cierre de sesión, edición de perfil.
- **Publicaciones:** creación, edición, eliminación y cambio de estado de artículos/servicios para trueque.
- **Categorías:** clasificación de publicaciones (gestionada por administrador).
- **Búsqueda y filtros:** por categoría, estado y palabra clave.
- **Mensajería / contacto:** comunicación entre el interesado y el dueño de una publicación.
- **Administración (opcional):** moderación de publicaciones reportadas y estadísticas básicas.
- **Reputación (opcional):** calificación entre usuarios tras completar un trueque.

### 2.3 Características de los Usuarios
El sistema define dos roles:
- **Usuario estudiante:** puede registrarse, publicar, buscar, contactar y gestionar sus propias publicaciones.
- **Administrador:** además de lo anterior, puede gestionar categorías y moderar publicaciones reportadas.

### 2.4 Restricciones
- El backend debe desarrollarse con Laravel 12 sobre PHP 8.2 o superior.
- La base de datos debe ser MySQL.
- El frontend debe construirse con Blade y Bootstrap.
- El sistema debe operar en idioma español.
- El registro debe restringirse, si la institución lo exige, a correos con el dominio institucional.

### 2.5 Suposiciones y Dependencias
- Se asume que los usuarios tienen conocimientos básicos de navegación web.
- El sistema depende de Composer para las dependencias de Laravel y, si se usa Bootstrap vía npm, de Node.js para compilar assets.
- Se asume conectividad a Internet (o a la red institucional) para acceder a la plataforma.
- Las imágenes de las publicaciones se asumen de tamaño moderado (ej. máximo 2–5 MB) y en formatos comunes (jpg, png).

### 2.6 Requerimientos Futuros
- Mensajería en tiempo real con WebSockets (aprovechable si ya tienes experiencia con Ratchet/Reverb).
- API REST y aplicación móvil complementaria (Flutter) para publicar y contactar desde el celular.
- Sistema de notificaciones push o por correo cuando llega un nuevo mensaje.
- Geolocalización o filtro por facultad/sede para facilitar el encuentro presencial.
- Verificación de identidad institucional más robusta (ej. correo institucional obligatorio con dominio validado).

---

## 3. Requerimientos Específicos

### 3.1 Requisitos Funcionales

| Código | Requerimiento |
|---|---|
| RF-01 | [Autenticación] Registrar un usuario con nombre, correo, contraseña y programa/facultad. |
| RF-02 | [Autenticación] Iniciar sesión con correo y contraseña. |
| RF-03 | [Autenticación] Cerrar sesión. |
| RF-04 | [Autenticación] Editar la información del perfil propio. |
| RF-05 | [Autenticación] Validar que el correo no esté duplicado al registrarse. |
| RF-06 | [Autenticación] Almacenar las contraseñas cifradas (hash). |
| RF-07 | [Publicaciones] Crear una publicación con título, descripción, categoría, imagen, lo que ofrece y lo que busca a cambio. |
| RF-08 | [Publicaciones] Editar una publicación propia. |
| RF-09 | [Publicaciones] Eliminar (soft-delete) una publicación propia. |
| RF-10 | [Publicaciones] Cambiar el estado de una publicación (disponible, reservado, intercambiado) desde el listado, sin abrir el formulario completo. |
| RF-11 | [Publicaciones] Listar las publicaciones activas a cualquier usuario autenticado. |
| RF-12 | [Publicaciones] Ver el detalle completo de una publicación. |
| RF-13 | [Categorías] Permitir al administrador el CRUD de categorías. |
| RF-14 | [Búsqueda] Filtrar publicaciones por categoría. |
| RF-15 | [Búsqueda] Filtrar publicaciones por estado. |
| RF-16 | [Búsqueda] Buscar publicaciones por palabra clave en título o descripción. |
| RF-17 | [Búsqueda] Combinar filtros y búsqueda simultáneamente. |
| RF-18 | [Mensajería] Permitir a un usuario contactar al dueño de una publicación mediante un mensaje interno. |
| RF-19 | [Mensajería] Mostrar el historial de mensajes asociado a una publicación. |
| RF-20 | [Mensajería] Impedir que un usuario se contacte a sí mismo sobre su propia publicación (RN-02). |
| RF-21 | [Administración] Permitir a un administrador eliminar u ocultar publicaciones reportadas. |
| RF-22 | [Administración] Mostrar al administrador estadísticas básicas (usuarios registrados, publicaciones activas, publicaciones intercambiadas). |
| RF-23 | [Reputación — opcional] Permitir calificar a otro usuario tras completar un trueque. |
| RF-24 | [Reputación — opcional] Mostrar el promedio de calificación de un usuario en su perfil. |

### 3.2 Requisitos No Funcionales

| Código | Requerimiento |
|---|---|
| RNF-01 | Proteger las rutas mediante autenticación de sesión (Laravel Auth / Breeze). |
| RNF-02 | Almacenar las contraseñas cifradas con bcrypt o equivalente. |
| RNF-03 | Implementar protección CSRF en todos los formularios. |
| RNF-04 | Validar y sanitizar toda entrada de usuario para prevenir inyección SQL y XSS. |
| RNF-05 | Usar MySQL como base de datos relacional, normalizada mínimo a 3FN. |
| RNF-06 | La interfaz debe ser responsiva (usable en móvil y escritorio) usando Bootstrap. |
| RNF-07 | El listado de publicaciones debe cargar en menos de 3 segundos con hasta 500 registros. |
| RNF-08 | Las búsquedas y filtros deben responder en menos de 2 segundos. |
| RNF-09 | Solo el propietario de una publicación (o un administrador) puede editarla o eliminarla. |
| RNF-10 | Organizar el código siguiendo la arquitectura MVC de Laravel. |
| RNF-11 | Las sesiones deben expirar tras un período de inactividad configurable. |
| RNF-12 | El sistema debe operar correctamente en los navegadores más comunes (Chrome, Firefox, Edge). |
| RNF-13 | El código debe poder desplegarse en un entorno de hosting estándar (LAMP) sin dependencias complejas adicionales. |
| RNF-14 | Implementar soft-delete en publicaciones y usuarios para conservar el historial. |

### 3.3 Otros Requisitos
- **Accesibilidad:** la interfaz debe ser utilizable desde computador y celular (RNF-06).
- **Compatibilidad:** funcionar en los navegadores más usados por la comunidad estudiantil.
- **Confiabilidad:** no debe perderse información de publicaciones ni mensajes ante errores del sistema.
- **Localización:** fechas e idioma en español, zona horaria local de la institución.

### 3.4 Reglas de Negocio

**RN-01 — Estados de una publicación**
Una publicación puede estar en tres estados: `disponible`, `reservado` (opcional, si se agrega una etapa intermedia) e `intercambiado`. Solo el dueño de la publicación puede cambiar su estado. Una publicación `intercambiada` deja de aparecer en los resultados de búsqueda por defecto, pero permanece visible en el historial del usuario.

**RN-02 — Restricción de autocontacto**
Un usuario no puede enviarse un mensaje a sí mismo sobre su propia publicación; el botón "Contactar" no debe mostrarse (o debe deshabilitarse) cuando el usuario autenticado es el dueño de la publicación.

**RN-03 — Permisos de edición y eliminación**
Solo el propietario de una publicación o un usuario con rol administrador puede editarla o eliminarla. Cualquier intento de acceso directo a la edición por otro usuario debe rechazarse (autorización a nivel de controlador, no solo ocultando el botón en la vista).

**RN-04 — Reputación (si se implementa)**
La opción de calificar a otro usuario solo se habilita cuando la publicación asociada pasa a estado `intercambiado`, y cada usuario puede calificar una sola vez por cada trueque completado.

**RN-05 — Moderación (si se implementa)**
Una publicación que acumule un número configurable de reportes (por ejemplo, 3) queda oculta automáticamente del listado público hasta que un administrador la revise y decida mantenerla o eliminarla.

---

## 4. Requerimientos Funcionales Detallados

### RFD-01 — Autenticación
| Campo | Detalle |
|---|---|
| Descripción | Permite a los usuarios registrarse, iniciar y cerrar sesión, y editar su perfil. |
| Entradas | name, email, password, programa/facultad |
| Fuente | Formulario Blade de registro/login |
| Salida | Sesión autenticada |
| Destino | Tabla `users` |
| Restricciones | El correo debe ser único; la contraseña se almacena con hash (RNF-02). |
| Proceso | El sistema valida los datos, crea o autentica al usuario y gestiona la sesión mediante Laravel Auth (o Breeze). |

### RFD-02 — Publicaciones
| Campo | Detalle |
|---|---|
| Descripción | CRUD de publicaciones con imagen, categoría, qué se ofrece y qué se busca a cambio, y cambio de estado desde el listado. |
| Entradas | título, descripción, categoría, imagen, ofrece, busca, estado |
| Fuente | Formularios de publicaciones (crear/editar) |
| Salida | Publicaciones creadas, editadas o con estado actualizado |
| Destino | Tabla `publicaciones` |
| Restricciones | Solo el dueño o un admin puede editar/eliminar (RN-03); el estado sigue RN-01. |
| Proceso | El sistema valida los datos, guarda la imagen, asocia la publicación al usuario autenticado y permite cambiar su estado con una sola acción desde el listado. |

### RFD-03 — Categorías
| Campo | Detalle |
|---|---|
| Descripción | CRUD de categorías, gestionado por el administrador. |
| Entradas | nombre, descripción (opcional) |
| Fuente | Formulario de categorías (panel admin) |
| Salida | Categorías creadas o actualizadas |
| Destino | Tabla `categorias` |
| Restricciones | No se puede eliminar una categoría con publicaciones asociadas. |
| Proceso | El sistema valida el nombre único y actualiza el listado de categorías disponible para las publicaciones. |

### RFD-04 — Búsqueda y Filtros
| Campo | Detalle |
|---|---|
| Descripción | Permite buscar y filtrar publicaciones por categoría, estado y palabra clave. |
| Entradas | texto de búsqueda, categoría, estado |
| Fuente | Barra de búsqueda y filtros del listado |
| Salida | Listado de publicaciones filtrado |
| Destino | Consulta sobre la tabla `publicaciones` |
| Restricciones | Los filtros deben poder combinarse; el tiempo de respuesta sigue RNF-08. |
| Proceso | El sistema construye la consulta combinando los filtros activos y la palabra clave, y devuelve el listado paginado. |

### RFD-05 — Mensajería / Contacto
| Campo | Detalle |
|---|---|
| Descripción | Permite a un usuario contactar al dueño de una publicación y ver el historial de mensajes. |
| Entradas | publicación_id, emisor_id, receptor_id, contenido |
| Fuente | Formulario de contacto en el detalle de la publicación |
| Salida | Mensaje registrado; historial de conversación |
| Destino | Tabla `mensajes` |
| Restricciones | Un usuario no puede contactarse a sí mismo (RN-02). |
| Proceso | El sistema valida que el emisor no sea el dueño de la publicación, guarda el mensaje y lo muestra en el historial correspondiente. |

### RFD-06 — Administración (opcional)
| Campo | Detalle |
|---|---|
| Descripción | Permite al administrador moderar publicaciones reportadas y ver estadísticas básicas. |
| Entradas | publicación reportada, motivo del reporte |
| Fuente | Panel de administración |
| Salida | Publicación oculta/eliminada; panel de estadísticas |
| Destino | Tablas `publicaciones`, `reportes` |
| Restricciones | Solo un usuario con rol admin accede a este módulo (RN-05). |
| Proceso | El sistema oculta automáticamente las publicaciones que superan el umbral de reportes y permite al admin revisarlas y decidir su destino. |

### RFD-07 — Reputación (opcional)
| Campo | Detalle |
|---|---|
| Descripción | Permite calificar a otro usuario tras completar un trueque. |
| Entradas | usuario_calificado_id, publicación_id, puntuación, comentario |
| Fuente | Formulario de calificación tras marcar una publicación como intercambiada |
| Salida | Calificación registrada; promedio actualizado en el perfil |
| Destino | Tabla `calificaciones` |
| Restricciones | Solo disponible cuando la publicación está en estado `intercambiado`; una calificación por trueque (RN-04). |
| Proceso | El sistema valida que el trueque esté completado, registra la calificación y recalcula el promedio del usuario calificado. |

---

## 5. Casos de Uso

**Autenticación**
- CU01 — Registrar usuario
- CU02 — Iniciar sesión
- CU03 — Cerrar sesión
- CU04 — Editar perfil

**Publicaciones**
- CU05 — Crear publicación
- CU06 — Editar publicación
- CU07 — Eliminar publicación
- CU08 — Cambiar estado de una publicación
- CU09 — Ver detalle de una publicación

**Categorías**
- CU10 — Gestionar categorías (admin)

**Búsqueda**
- CU11 — Buscar y filtrar publicaciones

**Mensajería**
- CU12 — Contactar al dueño de una publicación
- CU13 — Ver historial de mensajes

**Administración (opcional)**
- CU14 — Moderar publicaciones reportadas
- CU15 — Consultar estadísticas del sistema

**Reputación (opcional)**
- CU16 — Calificar a un usuario tras un trueque

### Detalle de casos de uso principales

**CU05 — Crear publicación**
Permite a un usuario autenticado registrar un nuevo artículo o servicio para trueque.
Campos: título, descripción, categoría, imagen, qué ofrece, qué busca.
Validaciones: todos los campos obligatorios deben diligenciarse; la imagen debe cumplir el formato y tamaño permitido; la publicación se crea en estado `disponible`.

**CU08 — Cambiar estado de una publicación**
Permite al dueño marcar su publicación como reservada o intercambiada.
Validaciones: solo el dueño puede ejecutar esta acción (RN-03); el cambio se refleja en el listado sin recargar todo el formulario.

**CU11 — Buscar y filtrar publicaciones**
Permite a cualquier usuario localizar publicaciones por categoría, estado o palabra clave.
Validaciones: los filtros pueden combinarse; si no hay resultados, se muestra un mensaje claro.

**CU12 — Contactar al dueño de una publicación**
Permite a un usuario interesado enviar un mensaje al dueño de una publicación.
Validaciones: el emisor no puede ser el dueño de la publicación (RN-02); el mensaje no puede estar vacío.

**CU14 — Moderar publicaciones reportadas**
Permite al administrador revisar publicaciones que han sido reportadas por otros usuarios.
Validaciones: solo un administrador accede a esta vista; la decisión (mantener/eliminar) queda registrada.

---

## 6. Historias de Usuario

**HU01 — Registro**
Como estudiante quiero registrarme con mi correo y contraseña para poder publicar y contactar a otros usuarios.
Criterios de aceptación: el correo no puede estar duplicado; debo recibir confirmación de registro exitoso; la contraseña debe cumplir un mínimo de seguridad.

**HU02 — Publicar un artículo**
Como estudiante quiero publicar un artículo que ya no uso para poder intercambiarlo por algo que necesito.
Criterios de aceptación: debo poder subir una imagen; debo indicar claramente qué ofrezco y qué busco; la publicación debe aparecer de inmediato en el listado.

**HU03 — Buscar publicaciones**
Como estudiante quiero buscar publicaciones por categoría o palabra clave para encontrar rápidamente lo que necesito.
Criterios de aceptación: los filtros deben poder combinarse; los resultados deben actualizarse sin recargar toda la página (o con una recarga rápida).

**HU04 — Contactar a otro usuario**
Como estudiante quiero contactar al dueño de una publicación para negociar el trueque.
Criterios de aceptación: no debo poder contactarme a mí mismo; debo ver el historial de mi conversación con esa persona.

**HU05 — Marcar una publicación como intercambiada**
Como estudiante quiero marcar mi publicación como intercambiada para que otros usuarios no sigan contactándome por ese artículo.
Criterios de aceptación: solo yo (el dueño) puedo cambiar el estado; la publicación debe dejar de aparecer en las búsquedas por defecto.

**HU06 — Moderar contenido (admin, opcional)**
Como administrador quiero revisar las publicaciones reportadas para mantener la plataforma libre de contenido inapropiado.
Criterios de aceptación: debo ver el motivo del reporte; debo poder eliminar u ocultar la publicación.

**HU07 — Calificar a otro usuario (opcional)**
Como estudiante quiero calificar a la persona con quien hice un trueque para ayudar a otros a confiar en ella.
Criterios de aceptación: solo puedo calificar una vez por trueque; la calificación solo se habilita cuando el trueque se marca como completado.

---

## 7. Diagramas de Actividades (descripción textual)

**Flujo: Publicar y recibir contacto**
1. El usuario inicia sesión.
2. Crea una publicación (título, descripción, categoría, imagen, ofrece/busca) → queda en estado `disponible`.
3. Otro usuario busca/filtra y encuentra la publicación.
4. El interesado envía un mensaje de contacto (el sistema valida que no sea el propio dueño).
5. El dueño responde y, si llegan a un acuerdo, marca la publicación como `intercambiado`.
6. (Opcional) Ambos usuarios se califican mutuamente.

**Flujo: Moderación (opcional)**
1. Un usuario reporta una publicación indicando un motivo.
2. El sistema cuenta los reportes acumulados.
3. Si se supera el umbral configurado, la publicación se oculta automáticamente.
4. El administrador revisa la publicación oculta.
5. Decide mantenerla (se reactiva) o eliminarla definitivamente.

> Si tu curso pide diagramas gráficos (BPMN o de actividades UML), puedo generarte las imágenes en un artifact o como parte del PDF/Word final — solo dime si los quieres en ese formato.

---

## 8. Entrevista y Tabulación de Resultados

> Esta sección es un ejemplo de cómo documentar la recolección de requisitos. Puedes usarla como plantilla y reemplazar las respuestas con las de una entrevista real a compañeros o al docente que hace las veces de "cliente".

### 8.1 Entrevista (ejemplo)

**1. ¿Qué problema busca resolver esta plataforma?**
Facilitar el intercambio de artículos y servicios entre estudiantes sin necesidad de dinero, aprovechando que muchos tienen objetos que ya no usan pero que podrían ser útiles para otros.

**2. ¿Quiénes usarán el sistema?**
Estudiantes de la institución, y opcionalmente un administrador que modere el contenido.

**3. ¿Qué información debe tener cada publicación?**
Título, descripción, categoría, una imagen, qué se ofrece y qué se busca a cambio.

**4. ¿Cómo deben contactarse los usuarios interesados?**
Mediante un mensaje interno dentro de la misma plataforma, para no exponer datos de contacto personales de forma pública.

**5. ¿Qué pasa cuando ya se realizó un trueque?**
El dueño debe poder marcar la publicación como intercambiada para que deje de recibir mensajes por ese artículo.

**6. ¿Es necesario un sistema de moderación?**
Sería deseable para evitar publicaciones inapropiadas o fraudulentas, aunque puede quedar como una mejora futura si el tiempo del proyecto es limitado.

**7. ¿Qué tan importante es que el sistema funcione bien en celular?**
Muy importante, porque la mayoría de los estudiantes revisará la plataforma desde su teléfono.

### 8.2 Tabulación de Resultados (ejemplo)
Si aplicas una encuesta corta a tus compañeros, puedes tabular preguntas como:
- ¿Usarías una plataforma de trueque estudiantil? (Sí/No/Tal vez)
- ¿Qué tipo de artículos intercambiarías con más frecuencia? (libros, tecnología, ropa, servicios académicos, otros)
- ¿Qué tan importante es la mensajería interna vs. mostrar el contacto directo?
- ¿Usarías principalmente la versión web o preferirías una app móvil?

---

## 9. Manual de Instalación

### 9.1 Requisitos del Sistema
- PHP 8.2 o superior.
- Composer 2.x.
- MySQL 8 (gestionado con Laragon).
- Node.js y npm (si se compilan assets de Bootstrap con Vite).
- Visual Studio Code.
- Git (opcional, recomendado para control de versiones).

### 9.2 Instalación del Proyecto
1. Instalar Laragon, Composer y Git (ver guía de instalación ya preparada).
2. Clonar o crear el proyecto: `composer create-project laravel/laravel truequeu`.
3. Copiar `.env.example` a `.env` y configurar `DB_DATABASE=truequeu`, `DB_USERNAME=root`, `DB_PASSWORD=`.
4. Generar la clave de la aplicación: `php artisan key:generate`.
5. Crear la base de datos `truequeu` desde HeidiSQL o phpMyAdmin (incluidos en Laragon).
6. Ejecutar las migraciones: `php artisan migrate` (y `--seed` si se preparan datos de prueba).
7. Instalar la autenticación con Laravel Breeze: `composer require laravel/breeze --dev` y luego `php artisan breeze:install`.
8. Instalar y compilar assets: `npm install` y `npm run dev` (o `npm run build` para producción).
9. Levantar el proyecto con `php artisan serve` o mediante el dominio automático de Laragon (`http://truequeu.test`).

### 9.3 Pruebas Básicas
- Registrar un usuario de prueba y verificar el inicio de sesión.
- Crear una publicación y confirmar que aparece en el listado.
- Probar los filtros de búsqueda con varias publicaciones.
- Enviar un mensaje desde una segunda cuenta y verificar que no se puede contactar la propia publicación.

---

## 10. Manual de Usuario

### 10.1 Descripción General
TruequeU permite a los estudiantes registrarse, publicar artículos o servicios para trueque, buscarlos mediante filtros y contactar a otros usuarios interesados.

### 10.2 Funcionalidades por Módulo

**Autenticación**
Registro con nombre, correo y contraseña; inicio y cierre de sesión; edición de perfil.

**Publicaciones**
Crear, editar y eliminar publicaciones propias; cambiar su estado (disponible/intercambiado) desde el listado.

**Búsqueda**
Filtrar por categoría y estado, y buscar por palabra clave; combinar ambos criterios.

**Mensajería**
Contactar al dueño de una publicación de interés y consultar el historial de la conversación.

**Administración (si se implementa)**
Revisar publicaciones reportadas y decidir si se mantienen o se eliminan; consultar estadísticas generales.

### 10.3 Flujo Típico de Uso
1. Registrarse o iniciar sesión.
2. Publicar un artículo que ya no se usa, indicando qué se busca a cambio.
3. Buscar entre las publicaciones de otros estudiantes usando los filtros.
4. Contactar al dueño de una publicación de interés.
5. Negociar el trueque por mensajería interna.
6. Marcar la publicación como intercambiada una vez concretado el trueque.
7. (Opcional) Calificar a la otra persona.
