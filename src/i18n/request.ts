import { getRequestConfig } from 'next-intl/server';
import { cookies, headers } from 'next/headers';

export default getRequestConfig(async () => {
  const locales = ['tr', 'en'];

  const defaultLocale = (await headers()).get('accept-language')?.split(',')[0];
  let locale = (
    (await cookies()).get('NEXT_LOCALE')?.value ||
    defaultLocale ||
    'tr'
  ).substring(0, 2);

  if (locales.indexOf(locale) == -1) {
    locale = 'tr';
  }

  return {
    locale,
    messages: (await import(`../../messages/${locale}.json`)).default,
  };
});
