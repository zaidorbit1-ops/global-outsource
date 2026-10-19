# Design spacing guidelines

## Vertical spacing between page sections

Use the homepage's section-to-section spacing consistently on every page:

| Viewport | Space between adjacent sections |
| --- | ---: |
| Desktop (over 900px) | 48px |
| Tablet (601px–900px) | 36px |
| Mobile (up to 600px) | 28px |

The `--section-gap` token in `assets/css/style.css` is the source of truth for these values. Apply it between each adjacent top-level section (and section-level navigation) inside the page's `<main>`. Do not substitute a smaller page-specific value or rely on each section's internal padding to create the inter-section gap.

The homepage uses `main#main-content` as the spacing reference. Pages with their own main layout, including the Accounting & Finance page, must preserve the same responsive values. For `.service-page`, adjacent top-level sections use `margin-top: var(--section-gap)` so the gap remains explicit and consistent.

Card spacing, heading-to-content spacing, and section padding are separate internal layout values; keep those separate from the section-to-section gap.

## Service navigation

All service detail pages must include `includes/service-switcher.php` rather than creating a page-specific service navigation. The shared component lists all seven service categories in a four-item first row and a three-item second row on desktop, and adapts to two columns on mobile. Only the actual current service page should have the active highlight. Keep its links and active-state mapping current as new service pages are added.

## Service card grids

Use three cards per row for service-page offering grids on desktop. Six services should form two balanced rows of three. Use two columns on tablet and one column on narrow mobile screens; do not override this shared grid per service page without a specific design requirement.

## Service page images

Keep all service-page images directly in `assets/services/`; do not create service-specific subfolders. Use descriptive filenames such as `accounting-finance.png`, `it-solutions.png`, `ai-solutions.png`, `software-development.png`, `managed-it-services.png`, `cloud-solutions.png`, and `business-process-support.png`.

## Our Expertise page images

The Our Expertise page uses the shared centered, text-only `includes/page-banner.php` breadcrumb banner. Its seven animated core-area cards use the matching service-page image with a consistent 5:3 frame and a small icon badge; preserve the source aspect ratio with `object-fit: cover` and avoid short, wide crops. Other non-home pages should use the same shared page-banner component for consistent breadcrumbs.
