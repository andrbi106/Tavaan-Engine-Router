# Tavaan Engine — Router

> **مسیریاب Compiled Trie** — موتور Router در فریمورک تَوان

## مشخصات

| فیلد | مقدار |
|---|---|
| شناسه | `tavaan.engine.router` |
| نام | `Router` |
| عنوان فارسی | مسیریاب Compiled Trie |
| نسخه | `0.1.0` |
| namespace | `Tavaan\Engine\Http\Routing` |
| نوع | `engine` |
| Facade | `Route` (accessor: `router`) |

## توضیحات

کد در engines/http/src/Routing (namespace مطابق DOC-040 machine block).

## Facadeها

- `Tavaan\Engine\Http\Routing\Facades\Route`

## کلاس‌های اصلی

- `src/Router.php`

## Service Providerها

- `Tavaan\Engine\Http\Routing\RouterServiceProvider`

## وابستگی‌ها

**موتورهای مورد‌نیاز:**

- `http`
- `container`
- `config`

## دستورات CLI

- `route:list`
- `route:cache`
- `route:clear`
- `route:match`

## پیکربندی

- فایل پیکربندی: `config/router.php`
- کلید: `router`

## نصب

```bash
git clone https://github.com/andrbi106/Tavaan-Engine-Router.git
```

این موتور بخشی از فریمورک تَوان است و معمولاً به‌صورت مستقیم نصب نمی‌شود،
بلکه توسط [Tavaan-Core](https://github.com/andrbi106/Tavaan-Core) مدیریت می‌شود.

## روابط با سایر مخازن

| مخزن | نقش |
|---|---|
| **`andrbi106/Tavaan-Engine-Router`** (این مخزن) | موتور Router |
| `andrbi106/Tavaan-Engine-Core` | ساختار پایه + درگاه ارتباط موتورها |
| `andrbi106/Tavaan-Core` | اسکلت اپلیکیشن + همهٔ موتورها |
| `Derogaramin/Tavaan-Framework` | فریمورک مادر (monorepo) |

## مجوز

MIT — هم‌راستا با فریمورک مادر تَوان.
