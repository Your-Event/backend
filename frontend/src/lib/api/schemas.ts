import { z } from "zod";

export const roleSchema = z.enum(["client", "restaurant", "showman", "admin"]);

export const loginRequestSchema = z.object({
  email: z.string().email("Enter a valid email."),
  password: z.string().min(6, "Password must be at least 6 characters."),
});

export const registerRequestSchema = z
  .object({
    role: z.enum(["client", "restaurant", "showman"]),
    name: z.string().min(2, "Name must be at least 2 characters."),
    email: z.string().email("Enter a valid email."),
    password: z.string().min(6, "Password must be at least 6 characters."),
    password_confirmation: z
      .string()
      .min(6, "Password confirmation must be at least 6 characters."),
  })
  .refine((data) => data.password === data.password_confirmation, {
    path: ["password_confirmation"],
    message: "Passwords do not match.",
  });

export const loginResponseSchema = z
  .object({
    token: z.string().optional(),
  })
  .passthrough();

export const registerResponseSchema = z
  .object({
    token: z.string().optional(),
  })
  .passthrough();

export const authMeResponseSchema = z.object({
  id: z.union([z.number(), z.string()]),
  role: roleSchema,
  name: z.string(),
  email: z.string().email(),
});
