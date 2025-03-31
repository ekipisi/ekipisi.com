import type { Metadata } from 'next';

import '@/styles/index.css';

import { NextIntlClientProvider } from 'next-intl';
import { getLocale } from 'next-intl/server';
import { Poppins } from 'next/font/google';
import { getLangDir } from 'rtl-detect';

import { env } from '@/utils/env';
import Navbar from '@/components/header/navbar';
import Providers from '@/providers/providers';

const poppins = Poppins({
  weight: ['400', '500', '600', '700'],
  variable: '--font-poppins',
  subsets: ['latin', 'latin-ext'],
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
      <body className={`${poppins.variable} max-w-full antialiased`}>
        <div className="flex flex-col overflow-x-clip">
          <NextIntlClientProvider>
            <Providers>
              <Navbar />
              {/* Main content area */}
              <div className="flex flex-grow flex-col">{children}</div>
            </Providers>
          </NextIntlClientProvider>
        </div>
      </body>
    </html>
  );
}
