import bcrypt from 'bcrypt';
import { NextAuthOptions } from 'next-auth';
import { JWT } from 'next-auth/jwt';
import CredentialsProvider from 'next-auth/providers/credentials';
import EmailProvider from 'next-auth/providers/email';
import GitHubProvider from 'next-auth/providers/github';
import GoogleProvider from 'next-auth/providers/google';

import { PrismaAdapter } from '@auth/prisma-adapter';

import { env } from './env';
import { prisma } from './prismaDb';

import type { Adapter } from 'next-auth/adapters';
export const authOptions: NextAuthOptions = {
  pages: {
    signIn: '/auth/signin',
  },
  adapter: PrismaAdapter(prisma) as Adapter,
  secret: process.env.SECRET,
  session: {
    strategy: 'jwt',
  },

  providers: [
    CredentialsProvider({
      name: 'credentials',
      credentials: {
        email: { label: 'Email', type: 'text', placeholder: 'Jhondoe' },
        password: { label: 'Password', type: 'password' },
        username: { label: 'Username', type: 'text', placeholder: 'Jhon Doe' },
      },

      async authorize(credentials) {
        // check to see if email and password is there
        if (!credentials?.email || !credentials?.password) {
          throw new Error('Please enter an email or password');
        }

        // check to see if user already exist
        const user = await prisma.user.findUnique({
          where: {
            email: credentials.email,
          },
        });

        // if user was not found
        if (!user || !user?.password) {
          throw new Error('Invalid email or password');
        }

        // check to see if passwords match
        const passwordMatch = await bcrypt.compare(
          credentials.password,
          user.password
        );

        // console.log(passwordMatch);

        if (!passwordMatch) {
          console.log('test', passwordMatch);
          throw new Error('Incorrect password');
        }

        return user;
      },
    }),

    GitHubProvider({
      clientId: env.GITHUB_CLIENT_ID!,
      clientSecret: env.GITHUB_CLIENT_SECRET!,
    }),

    GoogleProvider({
      clientId: env.GOOGLE_CLIENT_ID!,
      clientSecret: env.GOOGLE_CLIENT_SECRET!,
    }),

    EmailProvider({
      server: {
        host: env.EMAIL_SERVER_HOST,
        port: env.EMAIL_SERVER_PORT,
        auth: {
          user: env.EMAIL_SERVER_USER,
          pass: env.EMAIL_SERVER_PASSWORD,
        },
      },
      from: env.EMAIL_FROM,
    }),
  ],

  callbacks: {
    jwt: async (payload: { token: JWT; user?: { id: string } }) => {
      const { token } = payload;
      const user = payload.user;

      if (user) {
        return {
          ...token,
          id: user.id,
        };
      }
      return token;
    },

    session: async ({ session, token }) => {
      if (session?.user) {
        return {
          ...session,
          user: {
            ...session.user,
            id: token?.id,
          },
        };
      }
      return session;
    },
  },

  debug: process.env.NODE_ENV === 'development',
};
