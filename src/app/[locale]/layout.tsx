import '@styles/globals.css';

import { hasLocale, NextIntlClientProvider } from 'next-intl';
import { getTranslations } from 'next-intl/server';
import { Poppins } from 'next/font/google';
import { notFound } from 'next/navigation';
import { getLangDir } from 'rtl-detect';

import { routing } from '@/i18n/routing';
import ThemeProvider from '@/providers/theme-provider';
import { env } from '@lib/env';

import type { Metadata } from "next";

const poppins = Poppins({
  weight: ['400', '500', '600', '700'],
  variable: '--font-poppins',
  subsets: ['latin', 'latin-ext'],
});

export async function generateMetadata(): Promise<Metadata> {
  const t = await getTranslations("Meta");

  const imageData = {
    images: [{ url: env.SITE_URL + "/images/e-commerce-mobile.svg" }],
  };
  return {
    metadataBase: new URL(env.SITE_URL),
    title: {
      default: t("Title"),
      template: `%s • ${t("Title")}`,
    },
    description: t("Description"),
    openGraph: {
      ...imageData,
    },
    twitter: {
      card: "summary_large_image",
      ...imageData,
    },
    robots: {
      index: true,
      follow: true,
      googleBot: {
        index: true,
        follow: true,
        "max-video-preview": -1,
        "max-image-preview": "large",
        "max-snippet": -1,
      },
    },
  };
}

export default async function RootLayout({
  children,
  params,
}: {
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;
  const direction = getLangDir(locale);

  if (!hasLocale(routing.locales, locale)) {
    notFound();
  }

  return (
    <html
      lang={locale}
      dir={direction}
      suppressHydrationWarning
      className="scroll-smooth"
    >
      <body
        className={`${poppins.variable} mx-auto flex flex-col min-h-screen antialiased`}
      >
        <NextIntlClientProvider>
          <ThemeProvider
            attribute="class"
            defaultTheme="system"
            enableSystem
            disableTransitionOnChange
          >
            {children}
          </ThemeProvider>
        </NextIntlClientProvider>
      </body>
    </html>
  );
}
