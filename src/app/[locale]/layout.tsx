import type { Metadata } from 'next';

import '@/styles/index.css';

import { hasLocale, NextIntlClientProvider } from 'next-intl';
import { Inter } from 'next/font/google';
import { notFound } from 'next/navigation';

import { routing } from '@/i18n/routing';
import Theme from '@/providers/theme';
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
  params,
}: Readonly<{
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}>) {
  // Ensure that the incoming `locale` is valid
  const { locale } = await params;
  if (!hasLocale(routing.locales, locale)) {
    notFound();
  }

  return (
    // We suppress the Hydration warning because of the next-themes package.
    // It requires this to be set since, we don't really know the user theme
    // preference on the server side.
    <html lang={locale} suppressHydrationWarning>
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
