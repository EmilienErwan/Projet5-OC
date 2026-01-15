# Tom Troc - AI Coding Agent Instructions

## Architecture Overview

**Tom Troc** is a PHP book-exchange web application using an MVC pattern with manual dependency injection. The routing system in `index.php` dispatches requests via `action` query parameters to controllers, which orchestrate business logic through Manager classes.

### Core Components

- **Controllers** (`controllers/`): Route handlers (BookController, UserController, MessageController, AdminController) that instantiate Managers and pass data to Views
- **Models** (`models/`): 
  - `AbstractEntity`: Base class with auto-hydration system that converts underscore-named DB columns to camelCase setters
  - Entity classes (Book, User, Message) inherit from AbstractEntity
  - Manager classes (BookManager, UserManager, MessageManager) extend AbstractEntity and handle all DB queries
  - `DBConnect`: Singleton PDO wrapper with prepared statement support
- **Views** (`views/`): Template rendering engine that wraps content with `main.php` header/navigation
- **Configuration** (`config/`):
  - `autoload.php`: PSR-4-style spl_autoload_register scans services/, models/, controllers/, views/ for classes
  - `config.php`: Loads .env variables, defines template/image paths, starts sessions

## Key Patterns & Conventions

### Data Hydration
Entities auto-populate from associative arrays via camelCase conversion:
```php
$book = new Book(['id_book' => 1, 'title' => 'Example']); // id_book → setIdBook() → $idBook
```
Verify DB column names use underscores and setter methods follow camelCase + "set" prefix.

### Database Queries
All queries use `DBConnect::getInstance()->query()` with prepared statements:
```php
$stmt = $this->pdo->query("SELECT * FROM books WHERE id = ?", [$bookId]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
```
Note: `$this->pdo` is inherited from AbstractEntity via constructor; never instantiate DBConnect directly.

### View Rendering
Controllers pass data via `render()` second parameter:
```php
$view = new View("Page Title");
$view->render("templateName", ["book" => $book]); // Renders views/templates/templateName.php with $book accessible
```
The template file name does NOT include `.php` extension in the render call.

### Request/Response Flow
1. `index.php` receives `action` query param → matches case in switch statement
2. Controller instantiated → calls appropriate method
3. Manager query executed → returns object(s) or null
4. View rendered with template name and params array
5. `main.php` wraps content with header/nav (session check: `$_SESSION['log']` = logged-in user)

### HTML Context in Templates
All user data output wrapped in `htmlspecialchars()` to prevent XSS:
```php
<?= htmlspecialchars($book->getTitle()) ?>
```

## Common Development Tasks

### Adding a New Entity
1. Create entity class in `models/EntityName.php` extending `AbstractEntity`
2. Define properties with private visibility and matching DB column names (underscored)
3. Add getter/setter methods following pattern: `getId()`, `setId()`
4. Create `EntityNameManager.php` extending `AbstractEntity` with query methods
5. Register routes in `index.php` switch statement

### Updating Records
Managers handle INSERT/UPDATE. Example pattern from `UserManager::updateUser()`:
```php
$query = "UPDATE users SET name = :name WHERE id = :id";
$this->pdo->query($query, ["name" => $user->getName(), "id" => $user->getId()]);
```

### Handling Form Submissions
Controllers validate input, instantiate entities, call Manager methods, redirect:
```php
if (!isset($_POST['field'])) throw new Exception("Field required");
$entity->setField($_POST['field']);
$manager->update($entity);
header("Location: index.php?action=nextPage");
```

## Critical Files by Feature

- **Book Management**: `controllers/BookController.php` → `models/BookManager.php` → `views/templates/editBook.php`, `detailBook.php`
- **User Accounts**: `controllers/UserController.php` → `models/UserManager.php` → `views/templates/account.php`
- **Messaging**: `controllers/MessageController.php` → `models/MessageManager.php` → `views/templates/messages.php`
- **Navigation/Layout**: `views/templates/main.php` (header/nav wrap all pages)

## Error Handling

Controllers throw `Exception` with French error messages; `index.php` try-catch block should handle uncaught exceptions (implementation not shown—verify error handling mechanism).

## Environment & Dependencies

- PHP 7.4+ (uses typed properties and match-like syntax)
- MySQL with PDO
- Environment variables from `.env`: `DB_NAME`, `DB_HOST`, `DB_USER`, `DB_PASSWORD`
- No external frameworks (vanilla PHP MVC)
