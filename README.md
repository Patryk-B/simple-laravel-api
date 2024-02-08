# dev env via `laravel/sail` and `docker`:

follow these steps to setup the local dev env (based on `laravel/sail` and `docker`):

1. run `composer install`

2. copy `.env.example` and rename the copy to `.env`

3. run `php artisan key:generate --ansi`

4. open `.env` file and fill `DB_PASSWORD`

5. run either `npm run dev_windows_start` or `npm run dev_linux_start`\
    (this will start the app via `laravel/sail` and `docker`)

6. run either `npm run __dev_windows_sail_artisan_migrate_fresh_seed` or `npm run __dev_linux_sail_artisan_migrate_fresh_seed`
    (this will migrate and seed the database)

7. open http://localhost/mockSetup in the `browser` or `postman` to generate access tokens for local dev env.\
    **IMPORTANT**:
    - the page will appear only one time during the 1st visit. Any subsequential visit will result in an empty response. Please save tokens somewhere safe they are needed to authenticate api requests.\
    - this step needs to be repeated after every `<php|sail> artisan migrate fresh --seed` (or `npm run __dev_<windows|linux>_sail_artisan_migrate_fresh_seed`).

# features:

- simple user auth mockup\
**IMPORTANT**: to generate user tokes for auth visit http://localhost/mockSetup. The page will appear only one time during the 1st visit. Any subsequential visit will result in an empty response

- versioned CRUD api for movie database. Supports `GET`, `POST`, `PUT`, `PATCH`, `DELETE` requests.\
**IMPORTANT**: there is no hard RESTful standard, so I chose `response()->json(null, 204);` (empty body + 204 status) for `DELETE` request's response.
please see: http://www.vinaysahni.com/best-practices-for-a-pragmatic-restful-api

- movies can have a cover uploaded via api
