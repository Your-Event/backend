# YourEvent Web (Next.js) — PROJECT_LOG

## Repository
**Stack:** Next.js (App Router) + TypeScript  
**Purpose:** Frontend for YourEvent marketplace (clients + restaurants + showmans) consuming a separate API.

---

## Goals (Frontend)
- Public marketplace pages (SEO-first): provider listing, provider profile, packages, portfolio
- Auth pages and authenticated dashboards for each role:
    - Client dashboard: requests, proposals, bookings, messages
    - Provider dashboard: profile, portfolio, packages, incoming requests, proposals, bookings, messages
- Stable API integration layer (typed client) + consistent error handling
- High performance, good UX, and a reusable component system

---

## Non-Goals (Frontend Repo)
- Business logic ownership (belongs to backend)
- Payment processing backend flows (frontend only integrates if/when backend exposes)
- Data persistence beyond browser/session needs

---

## Architecture Principles
- **API-driven UI:** All domain data comes from the API; frontend maintains minimal derived state.
- **Typed boundaries:** All API payloads validated at runtime (Zod) and typed at compile-time (TS).
- **Separation:** UI components ≠ data fetching ≠ domain mapping.
- **Resilience:** standardized retry/backoff for idempotent reads; graceful empty/error states.
- **SEO & performance:** SSR/SSG where appropriate, caching for list pages, images optimized.

---

## Conventions
### Routing
- Next.js **App Router** with route groups:
    - `(public)` for marketing/search pages
    - `(auth)` for login/register flows
    - `(dashboard)` for authenticated role pages

### Data Fetching
- Server Components for SEO/public pages when feasible
- Client Components for interactive dashboards and forms
- React Query for client-side caching and mutations (recommended)

### Error Handling
- API errors mapped to a single normalized format:
    - `code`, `message`, `fieldErrors?`, `traceId?`
- UI uses:
    - global toast for transient errors
    - inline field errors for forms

### Auth Strategy (frontend-side)
- Tokens stored in **httpOnly cookies** preferred (if backend supports)
- Otherwise: bearer token in memory + refresh strategy
- Session bootstrap via `GET /auth/me` to infer role and route correctly

---

## Milestones (Frontend)
### M0 — Setup & Baseline
- Repo scaffold, lint, format, env samples
- API base client + health check
- Layouts, theme, component primitives

### M1 — Public Marketplace
- Provider listing with filters + pagination
- Provider profile page (portfolio + packages)
- SEO metadata, OG tags, loading states

### M2 — Auth & Role Routing
- Login/register/forgot/reset
- Route protection
- Role-based nav + dashboard shells

### M3 — Client Flows
- Create event request
- View proposals
- Accept proposal → booking view
- Messaging basic thread

### M4 — Provider Flows
- Provider profile editor
- Portfolio upload UI
- Packages CRUD
- Proposal submission + booking lifecycle

### M5 — Polish
- Performance passes
- Accessibility checks
- Analytics (optional)
- E2E smoke tests

---

## Decisions Log
(append new decisions here)

### 2026-01-25
- Frontend separated as `yourevent-web` with Next.js App Router.
- API integration via `NEXT_PUBLIC_API_BASE_URL` with typed client + Zod validation.
- Role-based dashboards: Client / Provider (Restaurant, Showman) / Admin (optional UI).
- Implemented login and registration pages (UI + validation + API integration) with role-based redirects.
- Added auth client utilities (fetch wrapper, session token store, guards) and shared auth UI components.
- Auth strategy confirmed: always `credentials: "include"`; attach bearer token only when API returns a token.
- Assumption: server error shape may vary; client normalizes `{ message }` and `{ errors: { field: [msg] } }` best-effort.
- Added cross-links between login and registration screens for smoother navigation.
- Removed input placeholders in auth forms to match the design and rely on labels.
- Reduced auth shell heading size to better align with the provided mockups.
- Updated the "Your Event" wordmark to an `h1` for semantic structure.
- Increased the "Your Event" wordmark size to match the 50-60px target.
- Added pointer cursor styling to auth buttons for clearer affordance.
- Replaced the registration role select with a three-option toggle-pill radio group.
- Styled role options with a custom `auth-toggle` global class for a cleaner, modern look.
- Increased role toggle pill size and switched to solid black styling.
- Updated checked toggle styling to white with a stronger box-shadow for selection.
- Added a checkmark icon for the selected role toggle.
- Added top margin to the role toggle row for spacing.

---

## Risks / Watch Items
- API contract changes without versioning → mitigate with strict typing + contract tests
- Auth method uncertainty (cookie vs bearer) → design adapter layer
- Large media (portfolio) affecting performance → use next/image + lazy loading
- Search/filter complexity → debounce + URL-driven filters to support shareable links

---

## Changelog Rules
For any notable change, add:
- date
- summary of change
- impact on routes/components/API client
