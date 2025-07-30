USE [bambi-bmi]
GO

/****** Object:  Table [dbo].[TEMP_mutasi]    Script Date: 01/31/2024 08:43:28 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[TEMP_mutasi](
	[SoTransacID] [char](15) NOT NULL,
	[Shipdate] [datetime] NULL,
	[SOEntryDesc] [text] NULL,
	[DateEntry] [datetime] NULL,
	[UserIDEntry] [char](10) NULL,
	[DateValidasi] [datetime] NULL,
	[UserIdValidasi] [char](10) NULL,
	[Lastdateaccess] [datetime] NULL,
	[UserId] [char](10) NULL,
	[flagposted] [char](1) NULL,
	[flagsave] [char](1) NULL,
 CONSTRAINT [PK_TEMP_mutasi] PRIMARY KEY CLUSTERED 
(
	[SoTransacID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TEMP_mutasi', @level2type=N'COLUMN',@level2name=N'flagposted'
GO

ALTER TABLE [dbo].[TEMP_mutasi] ADD  CONSTRAINT [DF_TEMP_mutasi_flagposted]  DEFAULT ('N') FOR [flagposted]
GO


