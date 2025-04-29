"use client";

import { ThemeProvider as NextThemesProvider, ThemeProviderProps } from 'next-themes';

import { Analytics } from '@vercel/analytics/next';
import { SpeedInsights } from '@vercel/speed-insights/next';

export default function ThemeProvider({
  children,
  ...props
}: ThemeProviderProps) {
  return (
    <NextThemesProvider {...props}>
      {children}
      <Analytics />
      <SpeedInsights />
    </NextThemesProvider>
  );
}
