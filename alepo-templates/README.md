# Alepo Template System

## Overview
This template system ensures consistency across all Alepo website pages while allowing for creative content generation.

## Structure

### 1. Block Library (`/block-library/`)
Reusable Gutenberg-compatible blocks that can be combined to create pages.

### 2. Page Templates (`/page-templates/`)
Complete page structures for each section type (products, solutions, industries).

### 3. Content Mapping (`/content-mapping/`)
Rules for how AI-generated content maps to template blocks.

## Template Philosophy

1. **Consistency First**: All pages in a section share the same structural template
2. **Content Flexibility**: Templates define structure, not content
3. **Gutenberg Native**: All templates output valid Gutenberg blocks
4. **Spectra Compatible**: Designed for non-technical editing
5. **Performance Optimized**: Minimal DOM depth, efficient CSS

## Usage

Templates are consumed by:
- `create-claude-pages.php` - WordPress page creation
- AI content generators - Structure guidelines
- Marketing team - Visual editing via Spectra

## Template Variables

Each template supports dynamic content injection:
- `{{headline}}` - Main page headline
- `{{subheadline}}` - Supporting text
- `{{primaryCTA}}` - Main call-to-action
- `{{content}}` - Body content blocks
- `{{stats}}` - Dynamic statistics
- `{{features}}` - Feature lists