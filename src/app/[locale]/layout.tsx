import { NextIntlClientProvider, hasLocale } from "next-intl";
import { notFound } from "next/navigation";
import { routing } from "@/i18n/routing";
import { getLangDir } from "rtl-detect";

import type { Metadata } from "next";
import { getTranslations } from "next-intl/server";
import ThemeProvider from "@/providers/theme-provider";
import { env } from "@lib/env";
import { Geist, Geist_Mono } from "next/font/google";
import "@styles/globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
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
        className={`${geistSans.variable} ${geistMono.variable} h-screen w-full antialiased`}
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
