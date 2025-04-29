"use client";

import { Analytics } from "@vercel/analytics/next";
import { SpeedInsights } from "@vercel/speed-insights/next";
import {
  ThemeProvider as NextThemesProvider,
  ThemeProviderProps,
} from "next-themes";

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
