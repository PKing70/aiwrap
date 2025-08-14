# AI Wrap - Laravel AI Tools

A clean Laravel application providing AI-powered tools for developers. This project has been cleaned to include only essential functionality.

## Features

### 1. Code Transpiler
Convert code between different programming languages while maintaining functionality.

**Supported Languages:**
- PHP
- JavaScript
- Python
- Java
- C#
- TypeScript
- Ruby
- Go

**Usage:**
1. Navigate to `/transpiler`
2. Paste your source code
3. Select source and target languages
4. Click "Transpile code"

### 2. Code Explainer
Get simple, plain-English explanations of code snippets in layman terms.

**What it explains:**
- **What the code does** - Clear description of the main purpose
- **How it works** - Step-by-step breakdown in simple terms
- **Key concepts** - Important programming concepts used
- **Real-world analogy** - Simple analogies to help understanding
- **Potential use cases** - When this type of code might be useful

**Usage:**
1. Navigate to `/explainer`
2. Paste your code snippet
3. Click "Explain Code"
4. Get a comprehensive explanation in plain English

### 3. HTML to DITA Transformer
Convert HTML content to valid DITA XML format for technical documentation.

**DITA Features:**
- **Valid DITA XML Structure** - Conforms to DITA 1.3/2.0 specifications
- **Topic Types** - Concept, Task, and Reference topics
- **Semantic Markup** - Proper DITA elements for meaning
- **Namespace Support** - Proper DITA namespace declarations
- **Export Options** - Copy XML or download .dita files

**Supported Conversions:**
- HTML headings → DITA topic titles
- HTML paragraphs → DITA `<p>` elements
- HTML lists → DITA `<ul>`/`<ol>` elements
- HTML tables → DITA `<table>` structure
- HTML links → DITA `<xref>`/`<link>` elements
- HTML code blocks → DITA `<codeblock>` elements
- HTML emphasis → DITA `<b>`/`<i>` elements
- HTML images → DITA `<image>` elements

**Usage:**
1. Navigate to `/dita`
2. Paste your HTML content
3. Select DITA topic type (Concept/Task/Reference)
4. Click "Transform to DITA"
5. Copy or download the valid DITA XML

### 4. Content Categorizer
Automatically categorize technical content with difficulty levels and keyword extraction.

**Categories:**
- **Concept**: Theoretical or explanatory content (what/why)
- **Task**: Step-by-step instructions (how to)
- **Reference**: Factual, reference-based content

**Difficulty Levels:**
- Beginner
- Intermediate
- Advanced

**Usage:**
1. Navigate to `/category`
2. Paste your technical content
3. Click "Categorize"
4. Get structured output with category, difficulty, and keywords

## Local Installation with DDEV

### Prerequisites

1. **Install DDEV** (if not already installed):
   ```bash
   # macOS with Homebrew
   brew install ddev/ddev/ddev
   
   # Or download from https://ddev.readthedocs.io/en/stable/users/install/
   ```

2. **Install Docker Desktop** (required for DDEV):
   - Download from: https://www.docker.com/products/docker-desktop/
   - Start Docker Desktop before proceeding

3. **Install Git** (if not already installed):
   ```bash
   # macOS
   brew install git
   
   # Or download from: https://git-scm.com/
   ```

### Installation Steps

1. **Clone the repository**:
   ```bash
   git clone <your-repository-url>
   cd aiwrap
   ```

2. **Initialize DDEV**:
   ```bash
   ddev config
   ```
   - Project name: `aiwrap` (or press Enter for default)
   - Docroot: `public` (press Enter)
   - Project type: `laravel` (press Enter)

3. **Start DDEV**:
   ```bash
   ddev start
   ```

4. **Install PHP dependencies**:
   ```bash
   ddev composer install
   ```

5. **Install Node.js dependencies**:
   ```bash
   ddev npm install
   ```

6. **Copy environment file**:
   ```bash
   ddev cp .env.example .env
   ```

   **Note:** Needed to run: ddev exec "cp .env.example .env"

7. **Generate application key**:
   ```bash
   ddev artisan key:generate
   ```

8. **Configure OpenAI API key**:
   ```bash
   ddev exec "sed -i 's/OPENAI_API_KEY=.*/OPENAI_API_KEY=your_actual_api_key_here/' .env"
   ```
   
   **Or manually edit `.env`**:
   ```bash
   ddev exec "nano .env"
   ```
   Find the line `OPENAI_API_KEY=` and add your OpenAI API key.

   **Note:** Needed to add the line altogether.

9. **Run database migrations**:
   ```bash
   ddev artisan migrate
   ```

   **Note:** Needed to change the DB settings in the .env file to:

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=db
   DB_USERNAME=db
   DB_PASSWORD=db
   ```

10. **Build frontend assets** (optional, for production):
    ```bash
    ddev npm run build
    ```

### Accessing the Application

- **Main URL**: https://aiwrap.ddev.site
- **Local URL**: http://aiwrap.ddev.site

### DDEV Commands

```bash
# Start the project
ddev start

# Stop the project
ddev stop

# Restart the project
ddev restart

# View project status
ddev status

# Access Laravel Artisan commands
ddev artisan migrate
ddev artisan route:list
ddev artisan cache:clear

# Access Composer commands
ddev composer install
ddev composer update

# Access NPM commands
ddev npm install
ddev npm run dev

# Access the web container shell
ddev ssh

# View logs
ddev logs
```

### Troubleshooting

1. **DDEV not starting**:
   ```bash
   ddev poweroff
   ddev start
   ```

2. **Permission issues**:
   ```bash
   ddev exec "chown -R www-data:www-data storage bootstrap/cache"
   ```

3. **Composer issues**:
   ```bash
   ddev composer install --ignore-platform-reqs
   ```

4. **Database connection issues**:
   ```bash
   ddev restart
   ddev artisan migrate:fresh
   ```

5. **OpenAI API errors**:
   - Verify your API key is correct in `.env`
   - Check your OpenAI account has sufficient credits
   - Ensure the API key has proper permissions

### Development Workflow

1. **Start development**:
   ```bash
   ddev start
   ```

2. **Make changes** to your code

3. **View changes** at https://aiwrap.ddev.site

4. **Run tests** (if available):
   ```bash
   ddev artisan test
   ```

5. **Stop when done**:
   ```bash
   ddev stop
   ```

### Environment Variables

Key environment variables in `.env`:

```env
APP_NAME="AI Wrap"
APP_ENV=local
APP_DEBUG=true
APP_URL=https://aiwrap.ddev.site

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=db
DB_PASSWORD=db

OPENAI_API_KEY=your_openai_api_key_here
```

### Team Sharing

To share this project with teammates:

1. **Share the repository URL**
2. **Share this README** with installation instructions
3. **Ensure everyone has DDEV installed**
4. **Share the `.env.example`** file (without sensitive data)

### Production Deployment

For production deployment, consider:

1. **Environment variables**: Set `APP_ENV=production`
2. **Debug mode**: Set `APP_DEBUG=false`
3. **Asset compilation**: Run `ddev npm run build`
4. **Database**: Use production database credentials
5. **Caching**: Run `ddev artisan config:cache`

## Project Structure

```
aiwrap/
├── app/
│   └── Http/Controllers/
│       ├── CategoryController.php
│       ├── DitaController.php
│       ├── ExplainerController.php
│       ├── OpenAIController.php
│       └── TranspilerController.php
├── resources/views/
│   ├── category/
│   │   └── index.blade.php
│   ├── dita/
│   │   └── index.blade.php
│   ├── explainer/
│   │   └── index.blade.php
│   ├── transpiler/
│   │   └── index.blade.php
│   └── welcome.blade.php
├── public/
│   ├── css/
│   │   ├── category.css
│   │   ├── dita.css
│   │   ├── explainer.css
│   │   └── transpiler.css
│   └── js/
│       ├── category.js
│       ├── dita.js
│       ├── explainer.js
│       └── transpiler.js
└── routes/
    ├── web.php
    └── api.php
```

## API Endpoints

- `GET/POST /api/openai-response` - Main AI processing endpoint

## Routes

- `/` - Welcome page with tool selection
- `/transpiler` - Code transpiler interface
- `/explainer` - Code explainer interface
- `/dita` - HTML to DITA transformer interface
- `/category` - Content categorizer interface

## Technologies Used

- **Laravel** - PHP framework
- **OpenAI API** - AI processing
- **jQuery** - Frontend interactions
- **Highlight.js** - Code syntax highlighting
- **DDEV** - Local development environment

## Contributing

This project is designed to be shared among team members. The codebase has been cleaned to include only essential functionality:

- Removed unused controllers and views
- Simplified API endpoints
- Clean, maintainable code structure
- Clear documentation

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
