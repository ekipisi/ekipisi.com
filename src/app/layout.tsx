import type { Metadata } from 'next';

import '@/styles/index.css';

import { NextIntlClientProvider } from 'next-intl';
import { getLocale } from 'next-intl/server';
import { Inter } from 'next/font/google';
import { getLangDir } from 'rtl-detect';

import Theme from '@/providers/providers';
import { env } from '@/utils/env';

const inter = Inter({
  variable: '--font-inter',
  subsets: ['latin'],
});

export async function generateMetadata(): Promise<Metadata> {
  return {
    metadataBase: new URL(env.SITE_URL),
    title: {
      default: 'Ekipişi',
      template: '%s • Ekipişi',
    },
    twitter: {
      card: 'summary_large_image',
    },
    robots: {
      index: true,
      follow: true,
      googleBot: {
        index: true,
        follow: true,
        'max-video-preview': -1,
        'max-image-preview': 'large',
        'max-snippet': -1,
      },
    },
  };
}

export default async function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  const locale = await getLocale();
  const direction = getLangDir(locale);

  return (
    // We suppress the Hydration warning because of the next-themes package.
    // It requires this to be set since, we don't really know the user theme
    // preference on the server side.
    <html lang={locale} dir={direction} suppressHydrationWarning={true}>
      <body
        className={`${inter.variable} mx-auto flex flex-col min-h-screen antialiased`}
      >
        <NextIntlClientProvider>
          <Theme>
            <div className="px-3 w-3xl max-w-3xl grow mx-auto antialiased">
              {children}
            </div>
          </Theme>
        </NextIntlClientProvider>
      </body>
    </html>
  );
}
