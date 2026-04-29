# YourEvent Web (Next.js) PROJECT_MAP

## Route Map
- `/` -> `src/app/page.tsx`
- `/login` -> `src/app/(auth)/login/page.tsx`
- `/register` -> `src/app/(auth)/register/page.tsx`

## Auth Module
- `src/lib/api/client.ts` - fetch wrapper (base URL, credentials include, error normalization, optional bearer token)
- `src/lib/api/schemas.ts` - Zod schemas for auth payloads
- `src/lib/api/types.ts` - inferred TypeScript types
- `src/lib/auth/session.ts` - token storage + `/auth/me` bootstrap
- `src/lib/auth/guards.ts` - role-based redirect helpers
- `src/components/auth/AuthShell.tsx` - shared auth page layout
- `src/components/forms/LoginForm.tsx` - login form UI + validation + API
- `src/components/forms/RegisterForm.tsx` - registration form UI + validation + API
- `src/components/ui/Button.tsx`
- `src/components/ui/Input.tsx`
- `src/components/ui/FormError.tsx`
- `src/components/ui/Spinner.tsx`

## API Integration Notes (Auth)
- Base URL: `NEXT_PUBLIC_API_BASE_URL`
- Endpoints:
  - `POST /auth/login`
  - `POST /auth/register`
  - `GET /auth/me`
- Auth strategy: always send `credentials: "include"`; if login/register returns a token, store it in memory + `localStorage` and attach `Authorization: Bearer <token>` on subsequent requests.

## Notes
- App Router source files live in `src/app`; root `app/` proxies to `src/app` to preserve routing while following the `src/` layout.
- Auth forms include cross-links between `/login` and `/register`.
- Auth inputs avoid placeholders; labels provide the field context.
- Auth shell heading reduced to better match design proportions.
- "Your Event" wordmark uses an `h1` tag for semantic hierarchy.
- "Your Event" wordmark sized to ~50-60px via `text-5xl`.
- Auth button uses pointer cursor for clearer affordance.
- Registration role uses custom toggle pills to match the design.
- Added `auth-toggle` global style for the role selector.
- Role toggle pills are larger and solid black by default.
- Checked role toggles switch to white with a stronger shadow.
- Checked role toggles display a checkmark icon.
- Role toggle row has added top margin for spacing.
