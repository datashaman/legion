# legion

Chat with OpenAI experts.

## installation

Create a repo using this as a template:

```
gh repo create legion --template datashaman/legion
```

Or clone the repository:

```
git clone https://github.com/datashaman/legion.git
```

## setup

```
cp .env.example .env
```

Set your `OPENAI_API_KEY` in `.env`, along with any other variables required, then:

```
composer install
php artisan migrate
```

Create a user:

```
php artisan user:create "myname" "myemail@example.com" "mypassword" --bio "My biography - used by avatar generator"
```

## run

```
php artisan serve
```

Navigate to `http://127.0.0.1:8000`, log in and create your first persona at `http://127.0.0.1/personas/create`.

## sources

The list of prompt templates come from [awesome chatgpt prompts](https://github.com/f/awesome-chatgpt-prompts/).

To regenerate the `resources/prompts.yml` file:

```
php artisan import-prompts
```
