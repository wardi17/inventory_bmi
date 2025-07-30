USE [bambi-bmi]
GO

/****** Object:  Table [dbo].[mutasidetail2]    Script Date: 02/12/2024 17:29:16 ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[mutasidetail2]') AND type in (N'U'))
DROP TABLE [dbo].[mutasidetail2]
GO

USE [bambi-bmi]
GO

/****** Object:  Table [dbo].[mutasidetail2]    Script Date: 02/12/2024 17:29:16 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[mutasidetail2](
	[SOTransacID] [char](15) NOT NULL,
	[Itemno] [float] NOT NULL,
	[PartId] [char](10) NULL,
	[PartName] [char](60) NULL,
	[prodclass] [char](10) NULL,
	[subprod] [char](10) NULL,
	[product] [char](10) NULL,
	[Quantity] [float] NULL,l
	[keterangan] [text] NULL,
	[Refno] [varchar](150) NULL,
	[batchno] [varchar](50) NULL,
	[warehouse] [varchar](50) NULL,
	[warehouse2] [varchar](50) NULL,
	[transtype] [varchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


