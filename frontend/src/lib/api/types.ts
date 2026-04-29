import { z } from "zod";

import {
  authMeResponseSchema,
  loginRequestSchema,
  loginResponseSchema,
  registerRequestSchema,
  registerResponseSchema,
  roleSchema,
} from "./schemas";

export type Role = z.infer<typeof roleSchema>;
export type LoginRequest = z.infer<typeof loginRequestSchema>;
export type LoginResponse = z.infer<typeof loginResponseSchema>;
export type RegisterRequest = z.infer<typeof registerRequestSchema>;
export type RegisterResponse = z.infer<typeof registerResponseSchema>;
export type AuthMeResponse = z.infer<typeof authMeResponseSchema>;
