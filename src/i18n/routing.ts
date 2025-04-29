import { defineRouting } from 'next-intl/routing';

import { defaultLanguage, languages } from '@constants/languages';

export const routing = defineRouting({
  locales: languages,
  defaultLocale: defaultLanguage,
  localeCookie: true,
  localeDetection: true,
});
